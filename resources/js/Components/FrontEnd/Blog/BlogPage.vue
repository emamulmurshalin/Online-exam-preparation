<template>
<div class="container-fluid">
    <div class="card background">
        <div class="row" v-if="dataLoaded">
            <div class="col-sm-9">
                <div v-for="post in posts" class="col-sm-6 bg-background" style="height: 350px">
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
                            <a href="" title="like" @click.prevent="likeAdd(post.id)"><i class="far fa-thumbs-up"></i></a>
                        </div>
                        <div class="col-sm-1">
                            <a href="" title="disliike" @click.prevent="disLikeAdd(post.id)"><i class="far fa-thumbs-down"></i></a>
                        </div>
                        <div class="col-sm-10">
                            <textarea  v-model="form[post.id]" name="comment" @keyup.enter="commentAdd(post.id)"
                                      class="form-control d-flex justify-content-center"
                                      placeholder="Enter comment"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3" style="background-color: yellow;
            height: 350px; margin-top: 15px; width: 23%;">

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
        postLikedOrNot(){
            this.posts.map((post)=>{

            });
        },
        checkDisliked(){
            this.posts.map((post)=>{

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
        likeAdd(postId){
            this.form.like = 1;
            this.form.post_id = postId;
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
                //this.errors = error.response.data.errors;
            }).finally(()=>{

            });
        },
        disLikeAdd(postId){
            this.form.dis_like = 1;
            this.form.post_id = postId;
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
                //this.errors = error.response.data.errors;
            }).finally(()=>{

            });
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
