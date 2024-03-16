<script setup lang="ts">

defineProps<{
    ability: any,
}>();

</script>
<template>
    <div class="flex" >
        <kbd class="ability shrink-0">
            <span>{{ ability.name }}</span>
        </kbd>
        <div class="grow">
            <span>{{ ability.description }}</span>
        </div>
    </div>
</template>
