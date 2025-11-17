<template>
    <div
        class="card-primary"
        :data-is-featured="post.is_featured"
    >
        <div class="card-primary__image">
            <img
                :src="post.imageSrc"
                :srcset="post.imageSrcset"
                sizes="(min-width: 1340px) 385px, (min-width: 768px) 32vw, 80vw"
                class=""
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
    }
</script>
