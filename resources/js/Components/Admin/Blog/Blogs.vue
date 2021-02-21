<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Blog post</h3>
                <div class="float-right">
                    <button @click.prevent="addPost" data-toggle="modal" class="btn btn-success">
                        Add post
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="example1_length">

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="example1_filter" class="dataTables_filter">
                                <label>
                                    Search:
                                    <input type="search" v-model="search" @keyup.enter="searchIt" class="form-control form-control-sm" placeholder="" aria-controls="example1">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">ID</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Title</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Content</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Total comment</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Status</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Category</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Created by</th>
                                    <th v-if="$gate.isAdmin()" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr role="row" class="even" v-for="post in posts.data" :key="post.id">
                                    <td class="sorting_1" tabindex="0">{{post.id}}</td>
                                    <td>{{post.title}}</td>
                                    <td>{{post.content}}</td>
                                    <td>{{post.comments.length}}</td>
                                    <td>{{post.status.name}}</td>
                                    <td>{{post.category.name}}</td>
                                    <td>{{post.user.first_name}} {{post.user.last_name}}</td>
                                    <td v-if="$gate.isAdmin()">
                                        <a href="#" @click.preven="editPost(post.id)">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        /
                                        <a href="#" @click.preven="deletePost(post.id)">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <pagination :data="posts" @pagination-change-page="loadPost">
                    <span slot="prev-nav">&lt; Previous</span>
                    <span slot="next-nav">Next &gt;</span>
                </pagination>
            </div>

            <app-post-modal v-if="isPostModal"
                      v-bind:selected-url="editedUrl"
                      @close-modal="closeModal">
            </app-post-modal>
            <!-- /.card-body -->
        </div>
    </div>

</template>

<script>
    export default {
        name: "Blogs",
        data() {
            return {
                isPostModal: false,
                editedUrl: '',
                search: '',
                posts: {},
            }
        },
        methods:{
            closeModal(modalId){
                this.isPostModal = false;
                $('#postModal').modal('hide');
                this.editedUrl= '';
                this.loadPost();
            },
            searchIt(){
                this.axios.get('/find-blog-post?search=' + this.search)
                    .then(response => {
                        this.posts = response.data;
                    }).catch((error) => {

                });
            },
            loadPost(page = 0){
                this.axios.get('/blogs?page=' + page)
                    .then(response => {
                        this.posts = response.data;
                    }).catch((error) => {

                });
            },
            deletePost(id){
                swal.fire({
                    title: 'Are you sure',
                    text: "This content will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.axios.delete(`/blogs/${id}`)
                            .then((response) => {
                                this.loadPost();
                                swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            }).catch((error) => {
                            swal.fire(
                                'Failed!',
                                'Something went wrong.',
                                'warning'
                            )
                        });
                    }
                })
            },
            addPost(){
                this.isPostModal = true;
                setTimeout(()=> {
                    $('#postModal').modal('show');
                })
            },
            editPost(id){
                this.editedUrl = `/blogs/${id}`;
                this.isPostModal = true;
                setTimeout(()=> {
                    $('#postModal').modal('show');
                })
            }
        },
        created() {
            this.loadPost();
        }
    }
</script>
