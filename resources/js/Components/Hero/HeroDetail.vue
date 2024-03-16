<script setup lang="ts">

import Ability from "@/Components/Hero/Ability.vue";

const props = defineProps<{
    hero: any,
}>();

</script>
<template>
    <div class="hero-detail">
        <div class="flex items-center">
            <img :src="`/images/heroes/` + hero.icon" :alt="hero.name">
            <div class="col-12">
                <h1 class="text-4xl">{{ hero.name }}</h1>
                <h3 class="text-xl">{{ hero.type}} {{hero.role}} <img :src="'/img/hero/role/' + hero.role.toLowerCase() + '_active.png'" alt=""></h3>
            </div>
        </div>
        <div class="grid grid-cols-2">
            <Ability v-for="ability in hero.abilities" :ability="ability"/>
        </div>
    </div>
</template>
