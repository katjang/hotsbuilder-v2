<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import HeroDetail from '@/Components/Hero/HeroDetail.vue';
import Rating from '@/Components/Rating.vue';
import CompactMap from '@/Components/Maps/Compact.vue';
import Talent from '@/Components/Hero/Talent.vue';
import Comment from "@/Components/Comment.vue";

const props = defineProps<{
    build: any,
    hero: any,
}>();

</script>
<template>
    <Head title="Build" />

    <div class="container mx-auto px-4 py-4">
        <HeroDetail :hero="hero"/>
        <div class="build mt-6">
            <div class="flex">
                <div class="grow">
                    <h2 class="text-3xl">{{ build.title }}</h2>
                    <p class="text-xl">{{ build.description }}</p>
                </div>
                <div class="flex">
                    <div>
                        <div>
                            <span>{{ build.rating_count }} votes</span>
                        </div>
                        <Rating :rating="build.avg_rating"/>
                    </div>
                    <div class="d-flex align-items-center">
                        <!-- @can('update', $build)
                            <a href="{{route('build.edit', $build)}}" class="fab-button-mini edit"><i class="material-icons">edit</i></a>
                        @endcan
                        @can('delete', $build)
                            {{Form::open(['route' => ['user.build.delete', Auth::user(), $build], 'method' => 'DELETE'])}}
                            <button type="submit" class="fab-button-mini delete"><i class="material-icons">delete</i></button>
                            {{Form::close()}}
                        @endcan -->
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div v-for="(talents, level) in hero.talents">
                    <div>
                        <h3 class="text-3xl">Level {{level}}:</h3>
                    </div>
                    <Talent v-for="talent in talents" :talent="talent" :selected="build.talents.map((b:any) => b.id).indexOf(talent.id) > -1"/>
                    <div>
                        <p>
                            {{build.talents.find((t: any) => t.level == level).pivot.note}}
                        </p>
                    </div>
                </div>
            </div>
            <div v-if="build.maps" class="mt-4">
                <h2 class="text-xl">Good maps for this build:</h2>
                <div class="flex">
                    <CompactMap v-for="map in build.maps" :map="map"/>
                </div>
            </div>
        </div>
        <!-- <div class="col-12 push-top text-white">
            {{Form::open(['route' => ['build.rating.store', $build]])}}
                <h2>Rate this build!</h2>
                {{Form::hidden('rating', null)}}
                @include('partials.rating._default', ['rating' => 0, 'extraClass' => 'rating-store'])
            {{Form::close()}}
        </div> -->
        <div class="comments mt-6">
            <h3 class="text-2xl">Comments</h3>
            <Comment v-for="aComment in build.comments" :comment="aComment" />
        </div>
        
    </div>
</template>
