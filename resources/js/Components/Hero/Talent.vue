<script setup lang="ts">

defineProps<{
    talent: any,
    selected: boolean,
}>();

</script>
<template>
    <div class="flex flex-column">
            <div class="talent static grow" :class="{'selected': selected}">
                <div class="content">
                    <div>
                        <h4 class="text-xl">
                            <img class="inline-block" :src="`/images/talents/` + talent.icon" :alt="talent.name"> 
                            {{ talent.name }}
                        </h4>
                    </div>
                    <div>
                        <p>
                            {{talent.description}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
</template>
