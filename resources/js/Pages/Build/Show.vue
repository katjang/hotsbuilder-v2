<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import HeroDetail from '@/Components/Hero/Detail.vue';

const props = defineProps<{
    build: any,
    hero: any,
}>();

</script>
<template>
    <Head title="Build" />

    <div class="container">
        <HeroDetail :hero="hero"/>
        <div class="build">
            <div class="d-flex push-top">
                <div class="flex-fill">
                    <h2>{{ build.title }}</h2>
                    <p>{{ build.description }}</p>
                </div>
                <div class="d-flex">
                    <div>
                        <div class="push-right">
                            <span>{{ build.rating_count }} votes</span>
                        </div>
                        <!-- @include('partials.rating._default', ['rating' => $build->avg_rating, 'extraClass' => '']) -->
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
            <div class="d-flex flex-wrap">
                <div class="col-12 col-lg-6" v-for="(talents, level) in hero.talents">
                    <div>
                        <h3>Level {{level}}:</h3>
                    </div>
                    <div class="form-group d-flex flex-column" v-for="talent in talents">
                        <div class="talent static" :class="{'selected': build.talents.indexOf(talent) > -1}">
                            <div class="content">
                                <div class="d-flex">
                                    <h4><img class="d-inline-block" :src="talent.image" :alt="talent.name"> {{ talent.name }}</h4>
                                </div>
                                <div class="col-12">
                                    <p>
                                        {{talent.description}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>
                            {{build.talents.find((t: any) => t.level == level).pivot.note}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12" v-if="build.maps">
                <h2>Good maps for this build</h2>
                <div class="d-flex flex-wrap">
                    <!-- @foreach($build->maps as $map)
                        @include('partials.map._compact', $map)
                    @endforeach -->
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
        <!-- @include('partials.comment._comments', ['comments' => $build->comments]) -->
    </div>
</template>
