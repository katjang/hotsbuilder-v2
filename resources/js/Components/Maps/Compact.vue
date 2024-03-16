<script setup lang="ts">

const props = defineProps<{
    map: any,
}>();

</script>
<template>
    <div class="map compact">
        <div class="content">
            <a href="#">
                <img :src="`/images/maps/` + map.image" :alt="map.name">
            </a>
        </div>
    </div>
</template>
