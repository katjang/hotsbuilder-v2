<script setup lang="ts">

const props = defineProps<{
    hero: any,
}>();

</script>
<template>
    <div class="hero-detail">
        <div class="d-flex align-items-center">
            <img :src="hero.image" :alt="hero.name">
            <div class="flex-fill">
                <div class="col-12">
                    <h1>{{ hero.name }}</h1>
                    <h3>{{ hero.type}} {{hero.role}} <img :src="'~/img/hero/role/' + hero.role.toLowerCase() + '_active.png'" alt=""></h3>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap">
            <div class="d-flex align-items-center col-6" v-for="ability in hero.abilities">
                <div class="ability flex-shrink-0">
                    <span>{{ ability.name }}</span>
                </div>
                <div class="flex-fill">
                    <span>{{ ability.description }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
