<script setup lang="ts">

const props = defineProps<{
    rating: number,
}>();

</script>
<template>
    <div class="rating flex row">
        <div class="rating-star-container d-flex relative" v-for="index in 5">
            <img src="/images/star_empty.png" alt="star">
            <img v-if="index < Math.ceil(rating)" src="/images/star.png" alt="star" class="absolute top-0">
            <img v-else-if="index == Math.ceil(rating)" src="/images/star.png" alt="star" class="absolute top-0" :style="{ clipPath: 'padding-box polygon(0 0,  '+ (props.rating - Math.floor(props.rating))*100 + '% 0, ' + (props.rating-Math.floor(props.rating))*100 + '% 100%, 0 100%)' }">
        </div>
    </div>
</template>
