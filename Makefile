# Local dev server — see README.md.

SHELL := bash
.SHELLFLAGS   := -eu -o pipefail -c
.DEFAULT_GOAL := help

# This site.
THEME        := ocp-v1
DB           ?= corporate_wp
PROD_URL     := https://www.open-contracting.org
PROD_WP      := /home/corporate/public_html
DISABLE      := ["ithemes-security-pro","redis-cache","w3-total-cache","wordfence","wp-cloudflare-page-cache"]
PHP_VERSION  := 8.1
# Cached options that embed absolute paths or IDs from the source site.
DROP_OPTIONS := 'rewrite_rules','wpml_language_switcher_template_objects'
# .env key holding a base URL that has to point at the local site.
ENV_URL_KEY  := IMGIX_BASE_URL
# Checked by `make serve`: REQUIRE is fatal, BUILT only warns. Leave REQUIRE empty if unused.
REQUIRE      := vendor/autoload.php
REQUIRE_HINT := composer install
BUILT        := dist/.vite/manifest.json
BUILT_HINT   := npm install && npm run production

# Overridable on the command line.
PORT    ?= 8090
WORKERS ?= 4
WORKDIR ?= $(HOME)/.cache/$(THEME)
TAR     ?= $(shell ls -t $(REPO)/*.tar $(REPO)/*.tar.gz 2>/dev/null | head -1)
DUMP    ?= $(shell ls -t $(REPO)/*.sql $(REPO)/*.sql.gz 2>/dev/null | head -1)
PHP     ?= $(firstword $(wildcard /opt/homebrew/opt/php@$(PHP_VERSION)/bin/php /usr/local/opt/php@$(PHP_VERSION)/bin/php) php)

# Derived.
REPO     := $(CURDIR)
WP       := $(WORKDIR)/public_html
URL      := http://localhost:$(PORT)
HTTP_URL := $(subst https://,http://,$(PROD_URL))
REL_URL  := $(subst https:,,$(PROD_URL))
SOCKET   := $(or $(shell mysql -uroot -N -sse "SELECT @@socket" 2>/dev/null),/tmp/mysql.sock)
MYSQL    := mysql -uroot
WP_CLI   := $(PHP) $(shell command -v wp)
# The table prefix is whatever the backup used.
OPTIONS  := SELECT table_name FROM information_schema.tables WHERE table_schema='$(DB)' AND table_name LIKE '%options' ORDER BY CHAR_LENGTH(table_name) LIMIT 1

.PHONY: help up setup db wp urls serve flush clean

help: ## list the available commands (runs by default)
	@grep -hE '^[a-z-]+:.*##' $(MAKEFILE_LIST) | sed -E 's/:[^#]*## /\t/'
	@echo "  serves $(URL) with $(WORKERS) workers, db=$(DB)"

up: setup ## setup and serve
	@$(MAKE) --no-print-directory serve

setup: db wp urls ## db, wp and urls

db: ## create and load the database (FORCE=1 to re-load), rewrite the site URL to localhost, activate this theme, disable production-only plugins, drop caches of production paths
	@test -f "$(DUMP)" || { echo "no SQL dump — set DUMP=/path/to.sql"; exit 1; }
	@$(MYSQL) -e 'CREATE DATABASE IF NOT EXISTS `$(DB)`;'
	@if [ -z "$(FORCE)" ] && [ "$$($(MYSQL) -N -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='$(DB)'")" -gt 0 ]; then \
		echo ">> DB already loaded (FORCE=1 to reimport)"; \
	else \
		echo ">> importing $$(basename "$(DUMP)")"; \
		$(MYSQL) -e 'DROP DATABASE `$(DB)`; CREATE DATABASE `$(DB)`;'; \
		case "$(DUMP)" in \
			*.gz) gzip -dc "$(DUMP)" | $(MYSQL) "$(DB)";; \
			*) $(MYSQL) "$(DB)" < "$(DUMP)";; \
		esac; \
	fi
	@options="$$($(MYSQL) -N -sse "$(OPTIONS)")"; \
	test -n "$$options" || { echo "no options table in $(DB)"; exit 1; }; \
	$(MYSQL) "$(DB)" -e "UPDATE $$options SET option_value='$(URL)' WHERE option_name IN ('siteurl','home');"; \
	$(MYSQL) "$(DB)" -e "UPDATE $$options SET option_value='$(THEME)' WHERE option_name IN ('template','stylesheet');"; \
	$(MYSQL) "$(DB)" -e "DELETE FROM $$options WHERE option_name IN ($(DROP_OPTIONS));"; \
	active="$$($(MYSQL) "$(DB)" -N -e "SELECT option_value FROM $$options WHERE option_name='active_plugins'")"; \
	printf "UPDATE $$options SET option_value='%s' WHERE option_name='active_plugins';" \
		"$$($(PHP) -r 'echo serialize(array_values(array_filter(unserialize($$argv[1]) ?: [], fn ($$plugin) => !in_array(explode("/", $$plugin)[0], json_decode($$argv[2], true), true))));' "$$active" '$(DISABLE)')" \
		| $(MYSQL) "$(DB)"; \
	stale="$$($(MYSQL) "$(DB)" -N -sse "SELECT GROUP_CONCAT(option_name) FROM $$options WHERE option_value LIKE '%$(PROD_WP)%'")"; \
	[ "$$stale" = NULL ] || echo ">> note: $(PROD_WP) is still in these options: $$stale"
	@echo ">> DB ready (url=$(URL), theme=$(THEME), production-only plugins disabled)"

wp: ## extract files into a working directory (FORCE=1 to re-extract), patch wp-config.php, write .env, symlink this directory as the theme
	@if [ -z "$(FORCE)" ] && [ -f "$(WP)/wp-load.php" ]; then \
		echo ">> files already extracted (FORCE=1 to re-extract)"; \
	else \
		test -f "$(TAR)" || { echo "no files backup — set TAR=/path/to.tar"; exit 1; }; \
		echo ">> extracting $$(basename "$(TAR)")"; \
		rm -rf "$(WORKDIR)/tmp" "$(WP)"; mkdir -p "$(WORKDIR)/tmp"; \
		tar -xf "$(TAR)" -C "$(WORKDIR)/tmp"; \
		load="$$(find "$(WORKDIR)/tmp" -maxdepth 5 -name wp-load.php -print -quit || true)"; \
		test -n "$$load" || { echo "no wp-load.php in $$(basename "$(TAR)")"; exit 1; }; \
		mv "$$(dirname "$$load")" "$(WP)"; rm -rf "$(WORKDIR)/tmp"; \
		env="$$(ls "$(WP)"/wp-content/themes/*/.env 2>/dev/null | head -1 || true)"; \
		[ -z "$$env" ] || cp "$$env" "$(WORKDIR)/env"; \
	fi
	@sed -i.bak -E \
		-e "s#define\( *'DB_NAME'[^;]*;#define('DB_NAME', '$(DB)');#" \
		-e "s#define\( *'DB_HOST'[^;]*;#define('DB_HOST', 'localhost:$(SOCKET)');#" \
		-e "s#define\( *'DB_USER'[^;]*;#define('DB_USER', 'root');#" \
		-e "s#define\( *'DB_PASSWORD'[^;]*;#define('DB_PASSWORD', '');#" \
		-e "s#define\( *'WP_CACHE'[^;]*;#define('WP_CACHE', false);#" \
		-e "s#define\( *'WP_HOME'[^;]*;#define('WP_HOME', '$(URL)');#" \
		-e "s#define\( *'WP_SITEURL'[^;]*;#define('WP_SITEURL', '$(URL)');#" \
		"$(WP)/wp-config.php" && rm -f "$(WP)/wp-config.php.bak"
	@for f in "$(WP)"/wp-content/advanced-cache.php "$(WP)"/wp-content/object-cache.php "$(WP)"/wp-content/mu-plugins/*auto-update*.php; do \
		[ -f "$$f" ] && mv -f "$$f" "$$f.disabled" || true; \
	done
	@if [ ! -f "$(REPO)/.env" ]; then \
		test -f "$(WORKDIR)/env" || { echo "no .env in the files backup — copy .env.example to .env and fill it in"; exit 1; }; \
		sed -E -e 's/^WP_ENV=.*/WP_ENV=local/' -e '/^$(ENV_URL_KEY)=/ s#https?://[^/]*#$(URL)#' "$(WORKDIR)/env" > "$(REPO)/.env"; \
		echo ">> wrote .env from the backup, with $(ENV_URL_KEY) rewritten to $(URL)"; \
	fi
	@rm -rf "$(WP)/wp-content/themes/$(THEME)" && mkdir -p "$(WP)/wp-content/themes" && ln -s "$(REPO)" "$(WP)/wp-content/themes/$(THEME)"
	@echo ">> WordPress ready, theme -> this checkout"

# URLs are also stored protocol-relative, and JSON-escaped inside some plugins' options.
# Replace the scheme-qualified forms first: the protocol-relative form is a substring of them.
urls: ## rewrite production URLs to localhost, including inside serialized and JSON values (needs wp-cli)
	@command -v wp >/dev/null || { echo "no wp-cli — run 'brew install wp-cli'"; exit 1; }
	@test -f "$(WP)/wp-load.php" || { echo "run 'make wp' first"; exit 1; }
	@set -- '$(PROD_URL)' '$(URL)' \
		'$(HTTP_URL)' '$(URL)' \
		'$(REL_URL)' '$(subst http:,,$(URL))' \
		'$(subst /,\/,$(PROD_URL))' '$(subst /,\/,$(URL))' \
		'$(subst /,\/,$(HTTP_URL))' '$(subst /,\/,$(URL))' \
		'$(subst /,\/,$(REL_URL))' '$(subst /,\/,$(subst http:,,$(URL)))'; \
	while [ $$# -gt 0 ]; do \
		$(WP_CLI) --path="$(WP)" --skip-plugins --skip-themes \
			search-replace "$$1" "$$2" --all-tables --precise --report-changed-only; \
		shift 2; \
	done

serve: ## start PHP's built-in server (php -S), with OPcache off so file edits take effect immediately
	@test -f "$(WP)/wp-load.php" || { echo "run 'make setup' first"; exit 1; }
	@[ -z "$(REQUIRE)" ] || test -f "$(REPO)/$(REQUIRE)" || { echo "run '$(REQUIRE_HINT)' first"; exit 1; }
	@[ -z "$(BUILT)" ] || test -f "$(REPO)/$(BUILT)" || echo ">> no built assets — run '$(BUILT_HINT)'"
	@options="$$($(MYSQL) -N -sse "$(OPTIONS)" 2>/dev/null || true)"; \
	url="$$([ -n "$$options" ] && $(MYSQL) "$(DB)" -N -sse "SELECT option_value FROM $$options WHERE option_name='siteurl'" || true)"; \
	[ "$$url" = "$(URL)" ] || { echo ">> siteurl is $$url, but this would serve $(URL) — every request would redirect. Run 'make db PORT=$(PORT)' first."; exit 1; }
	@echo ">> $(URL)  (Ctrl-C to stop)"
	@WP_ENVIRONMENT_TYPE=local PHP_CLI_SERVER_WORKERS=$(WORKERS) $(PHP) -d opcache.enable=0 -S localhost:$(PORT) -t "$(WP)"

flush: ## drop cached rewrite rules
	@options="$$($(MYSQL) -N -sse "$(OPTIONS)")"; \
	test -n "$$options" || { echo "no options table in $(DB)"; exit 1; }; \
	$(MYSQL) "$(DB)" -e "DELETE FROM $$options WHERE option_name='rewrite_rules';"
	@curl -s -o /dev/null "$(URL)/" || true
	@echo ">> flushed"

clean: ## drop the database and remove the working directory
	@rm -rf "$(WORKDIR)"
	@$(MYSQL) -e 'DROP DATABASE IF EXISTS `$(DB)`;'
	@echo ">> cleaned"
