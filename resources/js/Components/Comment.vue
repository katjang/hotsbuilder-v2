<script setup lang="ts">

import Comment from "@/Components/Comment.vue";

defineProps<{
    comment: any,
}>();

</script>
<template>
    <div class="comment">
        <div class="flex justify-between px-2">
            <div class="flex align-center">
                <strong class="">By: <a href="#" v-if="comment.user">{{ comment.user.name }}</a></strong>
                <!-- @if($user->role == \App\UserRole::MODERATOR)
                    <img src="{{asset('img/moderator.png')}}" alt="MOD" class="moderator-icon">
                @endif -->
            </div>
            <!-- @include('partials.user._label', ['user' => $comment->user]) -->
            <div class="flex">
                <small>{{comment.updated_at}}</small>
            </div>
        </div>
        <div class="content">
            <div class="flex px-2 py-1">
                <div class="grow">
                    <i v-if="!comment.body">This comment has been deleted.</i>
                    {{comment.body}}
                </div>
                <div v-if="comment.body">
                    <!-- @auth
                    @can('remove', $comment)
                        {{Form::open(['route' => ['comment.remove', $comment], 'method' => 'PUT'])}}
                        <button type="submit" class="icon-button-mini delete"><i class="material-icons">delete</i></button>
                        {{Form::close()}}
                    @endcan
                    <button class="icon-button-mini open-reply">
                        <i class="material-icons">reply</i>
                    </button>
                    @endauth -->
                </div>
            </div>
            <div class="replies">
                <!-- {{Form::open(['route' => ['reply.store', $comment], 'class' => 'd-none reply-form col-12'])}}
                <div class="form-group">
                    {{Form::textarea('body', null, ['class' => ('form-control '. ($errors->has('body')?'is-invalid' : ''))])}}
                </div>
                <div class="form-group text-right">
                    {{Form::submit('Comment', ['class' => 'btn btn-success'])}}
                </div>
                {{Form::close()}} -->
                <Comment v-for="aComment in comment.comments" :comment="aComment" />
                <!-- @if(!isset($commentLayer) || $commentLayer < 4)
                    @include('partials.comment._layer', ['comments' => $comment->comments, 'commentLayer' => (!isset($commentLayer)? 1: $commentLayer+1)])
                @elseif($comment->has_comment) -->
                <div class="col-12">
                    <!-- <a href="{{route('comment.show', $comment)}}">Continue this chain</a> -->
                </div>
            </div>
        </div>
    </div>
</template>
