<template>
    <div id="postModal" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="selectedUrl" class="modal-title">Edit post</h5>
                    <h5 v-else class="modal-title">Add post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="quickForm">
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-3">Title</label>
                                <div class="col-sm-9">
                                    <input v-model="form.title" type="text" name="title"
                                           class="form-control" placeholder="Enter title" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Content</label>
                                <div class="col-sm-9">
                                    <textarea v-model="form.content" name="content"
                                              class="form-control d-flex justify-content-center"
                                              placeholder="Enter content"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Post category</label>
                                <div class="col-sm-9">
                                    <select v-model="form.category_id" class="form-control">
                                        <option v-for="(category, index) in categoryData" v-bind:value="category.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                            {{category.name}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Select status</label>
                                <div class="col-sm-9">
                                    <select v-model="form.status_id" class="form-control">
                                        <option v-for="(status, index) in statusData" v-bind:value="status.id" :key="index" :selected="index === 0 ? 'selected' : ''">
                                            {{ status.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Cancel
                    </button>
                    <button v-if="selectedUrl" type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <button v-else type="submit" class="btn btn-primary" @click.prevent="submit">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PostModal",
    props: ['selectedUrl'],
    data(){
        return{
            categoryData: {},
            statusData: {},
            form: new Form({
                title: '',
                content: '',
                category_id: '',
                status_id: ''
            })
        }
    },
    mounted() {
        this.getCategory();
        this.getStatus();
    },
    methods:{
        getCategory(){
            this.axios.get('/get-post-category')
                .then((response) => {
                    this.categoryData = response.data;
                }).catch(()=>{

            });
        },
        getStatus(){
            this.axios.get('/get-status')
                .then((response) => {
                    this.statusData = response.data;
                }).catch(()=>{

            });
        },
        submit(){
            this.axios.post('/blogs', this.form)
                .then((response) => {
                    toast.fire({
                        icon: 'success',
                        title: 'Post created successfully'
                    });
                    this.form.title = '';
                    this.form.content = '';
                    this.form.category_id = '';
                    this.form.status_id = '';
                    this.closeModal();
                }).catch(()=>{
                this.closeModal();
            });
        },

        closeModal(){
            this.$emit("close-modal", this.modalId);
        }
    }
}
</script>
<style scoped>
.modal-lg {
    max-width: 48%;
}
</style>
