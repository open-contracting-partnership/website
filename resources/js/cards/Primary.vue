<template>
    <div
        class="card-primary"
        :data-is-featured="post.is_featured"
    >
        <div class="card-primary__image">
            <img
                :src="`${imgixUrl}?auto=format&amp;fit=crop&amp;w=415&amp;h=234`"
                class=""
                :srcset="`
                    ${imgixUrl}?auto=format&amp;fit=crop&amp;w=415&amp;h=234 415w,
                    ${imgixUrl}?auto=format&amp;fit=crop&amp;w=830&amp;h=467 830w,
                    ${imgixUrl}?auto=format&amp;fit=crop&amp;w=1024&amp;h=576 1024w,
                    ${imgixUrl}?auto=format&amp;fit=crop&amp;w=1536&amp;h=864 1536w,
                    ${imgixUrl}?auto=format&amp;fit=crop&amp;w=2048&amp;h=1152 2048w
                `"
                sizes="(min-width: 1340px) 385px, (min-width: 768px) 32vw, 80vw"
                alt=""
                width="16"
                height="9"
                loading="lazy"
            >
        </div>

        <div class="card-primary__main">
            <div v-if="post.type_label" class="card-primary__tag" data-tag="post.type_key">{{ post.type_label }}</div>

            <a class="card-primary__title" :href="post.url">
                {{ post.title }}
            </a>

            <p v-if="post.introduction" class="card-primary__introduction">{{ post.introduction }}</p>

            <p v-if="post.tags" class="card-primary__topics">
                Issues:

                <a
                    v-for="(tag, index) in post.tags"
                    :key="index"
                    :href="tag.link"
                    class="card-primary__topics-link"
                >
                    {{ tag.name }}<span v-if="index < post.tags.length - 1">, </span>
                </a>
            </p>

            <div v-if="post.meta" class="card-primary__footer">
                <div class="card-primary__meta">
                    <span v-if="post.meta.primary" class="card-primary__meta-primary">{{ post.meta.primary }}</span>

                    <span v-if="post.meta.secondary" class="card-primary__meta-secondary">{{ post.meta.secondary }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            post: {
                type: Object,
                required: true
            }
        },

        computed: {
            imgixUrl() {
                if (! this.post.image_url) {
                    return 'https://ocp.imgix.net/wp-content/themes/ocp-v1/resources/img/fallback-v2.jpg';
                }

                const urlParts = this.post.image_url.split('/wp-content/');

                return 'https://ocp.imgix.net/wp-content/' + urlParts[1];
            }
        }
    }
</script>
