<template>
<div class="container-fluid">
    <div class="card background">
        <div class="row" v-if="dataLoaded">
            <div class="col-sm-12">
                <div v-for="post in posts" class="col-sm-4 bg-background" style="height: 350px">
                    <div style="margin-top: 5px">
                        <h4 style="color: black">{{ post.title | titleTruncate }}</h4>
                    </div>
                    <div style="height: 230px">
                        <img style="margin-top: 15px; width: 100%; border-radius: 2%;"
                             align="center"
                             class="justify-content-center" :src="getImage(post.file_path)"
                             alt="User Avatar">
                    </div>
                    <div style="margin-top: 3px">
                        <p style="color: black;">{{ post.content | textTruncate }}...<a href="" @click.prevent="seeMore">See more</a></p>
                    </div>
                    <div style="margin-top: 3px" class="row">
                        <div class="col-sm-4">
                            <p style="background-color: #F5F5F5;">{{ post.comments.length }} comments</p>
                        </div>
                        <div class="col-sm-8" v-if="post.comments.length">
                            <p style="background-color: #F5F5F5; color:black;">
                                <a href="">
                                    {{ post.user.first_name + ' ' + post.user.last_name + ' ' }}
                                </a>
                                {{ post.comments[0].comment | titleTruncate }}
                            </p>
                        </div>
                    </div>
                    <div v-if="userLogin" style="margin-top: 7px; height: 50px" class="row">
                        <div class="col-sm-1">
                            <a href=""
                               :title="post.liked ? 'like' : 'Unlike'"
                               @click.prevent="likeAdd(post)">
                                <i class="far fa-thumbs-up"></i>
                            </a>
                        </div>
                        <div class="col-sm-1">
                            <a href=""
                               :title="(post.post_dislike ? post.post_dislike.length : 0) + ' disliikes'"
                               @click.prevent="disLikeAdd(post)">
                                <i class="far fa-thumbs-down"></i>
                            </a>
                        </div>
                        <div class="col-sm-10">
                            <textarea  v-model="form[post.id]" name="comment" @keyup.enter="commentAdd(post.id)"
                                      class="form-control d-flex justify-content-center"
                                      placeholder="Enter comment"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
name: "BlogPage",
    data(){
        return{
            dataLoaded: false,
            likedPost: null,
            posts: {},
            form: new Form({
                comment: '',
                post_id: ''
            }),
        }
    },
    computed:{
        userLogin(){
            return window.user;
        },
        checkLiked(){
            return this.posts.map((post)=>{
                let totalLike = 0;
                let totalUnLike = 0;
                let likedPost = post.post_like.find((liked) =>{
                    if (liked.like == 1){
                        totalLike = totalLike + 1;
                    }else {
                        totalUnLike = totalUnLike + 1;
                    }
                    if (liked.user_id == window.user.id && liked.like == 1){
                        return liked;
                    }
                });
                post.totalLike = totalLike;
                post.totalUnLike = totalUnLike;
                if (likedPost){
                    post.liked = true;
                }else {
                    post.liked = false;
                }
            });
        },
        checkDisliked(){
            this.posts.map((post)=>{
                let disliked = post.post_dislike.find((dislike)=>{
                    if (dislike.user_id == window.user.id && dislike.dis_like == 1){
                        return dislike;
                    }
                });
                if (disliked){
                    post.disliked = true;
                }else {
                    post.disliked = false;
                }
            });
        }
    },
    mounted() {
        this.loadPost();
    },
    methods:{
        seeMore(){
           console.log('hoise');
        },
        likeAdd(post){
             let likedPost = post.post_like.find((liked)=>{
                if (liked.user_id == window.user.id){
                    return liked;
                }
            });
            if (likedPost){
                if (likedPost.like == 1){
                    this.form.like = 0;
                    this.form.post_id = likedPost.post_id;
                    this.axios.patch(`/post-unlike/${likedPost.id}`, this.form)
                        .then((response) => {
                            toast.fire({
                                icon: 'success',
                                title: 'Unliked'
                            });
                            this.form = {};
                            this.loadPost();
                        }).catch(error=>{

                    }).finally(()=>{

                    });
                }else {
                    this.form.like = 1;
                    this.form.post_id = likedPost.post_id;
                    this.axios.patch(`/post-like-update/${likedPost.id}`, this.form)
                        .then((response) => {
                            toast.fire({
                                icon: 'success',
                                title: 'liked'
                            });
                            this.form = {};
                            this.loadPost();
                        }).catch(error=>{

                    }).finally(()=>{

                    });
                }
            }else {
                this.form.like = 1;
                this.form.post_id = post.id;
                this.form.user_id = window.user.id;
                this.axios.post('/post-like', this.form)
                    .then((response) => {
                        toast.fire({
                            icon: 'success',
                            title: 'liked'
                        });
                        this.form = {};
                        this.loadPost();
                    }).catch(error=>{

                }).finally(()=>{

                });
            }
        },
        disLikeAdd(post){
            let disliked = post.post_dislike.find((dislike)=>{
                if (dislike.user_id == window.user.id && dislike.dis_like == 1){
                    return dislike;
                }
            });
            if (disliked){
                toast.fire({
                    icon: 'success',
                    title: 'Already disliked'
                });
            }else {
                this.form.dis_like = 1;
                this.form.post_id = post.id;
                this.form.user_id = window.user.id;
                this.axios.post('/post-dislike', this.form)
                    .then((response) => {
                        toast.fire({
                            icon: 'success',
                            title: 'disliked'
                        });
                        this.form = {};
                        this.loadPost();
                    }).catch(error=>{
                }).finally(()=>{

                });
            }
        },
        commentAdd(postId){
            this.form.post_id = postId;
            this.form.user_id = window.user.id;
            this.form.comment = this.form[postId];
            this.axios.post('/post-comment', this.form)
                .then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'You comment in a post'
                    });
                    this.form = {};
                    this.loadPost();
                }).catch(error=>{
                //this.errors = error.response.data.errors;
            }).finally(()=>{

            });
        },
        getImage(imageName){
            if (imageName){
                return '/Post/'+imageName;
            }
            return '/Post/default.png';
        },
        loadPost(){
            this.dataLoaded = false;
            this.axios.get('/blogs?blog')
                .then(response => {
                    this.posts = response.data;
                    this.dataLoaded = true;
                }).catch((error) => {

            });
        },
    }
}
</script>
<style>
.bg-background{
    min-height: 450px;
    height: auto;
}
.background{
    min-height: 450px;
    height: auto;
    background-color: #F5F5F5;
    margin-bottom: 10px;
    margin-top: 10px;
}
</style>
