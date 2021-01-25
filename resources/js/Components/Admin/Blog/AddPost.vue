<template>
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add Blog Post</h3>
            </div>
            <form class="form-horizontal">
                <div class="card-body bg-color">
                    <div class="form-group row">
                        <label class="col-sm-3">Title</label>
                        <div class="col-sm-8">
                            <input v-model="form.title" type="text" name="title"
                                   class="form-control" placeholder="Enter title" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Content</label>
                        <div class="col-sm-8">
                                    <textarea v-model="form.content" name="content"
                                              class="form-control d-flex justify-content-center"
                                              placeholder="Enter content"></textarea>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="float-right bg-color mr-2 mb-3 mt-3">
                    <button class="btn btn-default pr-4 pl-4 mr-2">Cancel</button>
                    <button type="submit" class="btn btn-info pr-4 pl-4" @click.prevent="addPost">Save</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddPost",
        props: ['selectedUrl'],
        data(){
            return{
                form: new Form({
                    title: '',
                    content: '',
                })
            }
        },
        created() {
            console.log(this.selectedUrl, 'url');
        },
        methods:{
            addPost(){
                this.axios.post('/blogs', this.form)
                    .then((response) => {
                        window.location.replace('/users/blog-post');
                        toast.fire({
                            icon: 'success',
                            title: 'User created successfully'
                        });
                        this.form.title = '';
                        this.form.content = '';
                    }).catch(()=>{

                });
            }
        }
    }
</script>

<style scoped>
    .bg-color {
        background-color: #F5F5F5;
    }
</style>