<template>
    <div class="container">
        <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
                <h3 class="card-title">User List view</h3>
                <div class="float-right">
                    <button @click.prevent="addUser" data-toggle="modal" class="btn btn-success">
                        Add user
                        <i class="fas fa-user-plus fa-fw"></i>
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
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Name</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Email</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Role</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Status</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Created at</th>
                                        <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row" class="even" v-for="user in users.data" :key="user.id">
                                        <td class="sorting_1" tabindex="0">{{user.id}}</td>
                                        <td>{{user.first_name}} {{user.last_name}}</td>
                                        <td>{{user.email}}</td>
                                        <td>{{user.role}}</td>
                                        <td>{{user.status.name}}</td>
                                        <td>{{user.created_at | localDate}}</td>
                                        <td>
                                            <a href="#" @click.prevent="editUser(user.id)">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            /
                                            <a href="#" @click.preven="deleteUser(user.id)">
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
                <pagination :data="users" @pagination-change-page="loadUser">
                    <span slot="prev-nav">&lt; Previous</span>
                    <span slot="next-nav">Next &gt;</span>
                </pagination>
            </div>
            <!-- /.card-body -->

            <add-user v-if="isUserModal"
                      v-bind:selected-url="editedUrl"
                      @close-modal="closeModal">
            </add-user>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Users",
        data() {
            return {
                search: '',
                users: {},
                editedUrl: '',
                isUserModal: false,
            }
        },
        methods:{
            searchIt(){
                this.axios.get('/find-user?search=' + this.search)
                    .then(response => {
                        this.users = response.data;
                    }).catch((error) => {

                });
            },
            closeModal(modalId){
                this.isUserModal = false;
                $('#userModal').modal('hide');
                this.editedUrl= '';
                this.loadUser();
            },
            loadUser(page = 0){
                this.axios.get('/users?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    }).catch((error) => {

                });
            },
            addUser(){
                this.isUserModal = true;
                setTimeout(()=> {
                    $('#userModal').modal('show');
                })
            },
            deleteUser(id){
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
                        this.axios.delete(`/users/${id}`)
                            .then((response) => {
                                this.loadUser();
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

            editUser(id){
                this.editedUrl = `/users/${id}`;
                this.isUserModal = true;
                setTimeout(()=> {
                    $('#userModal').modal('show');
                })
            }
        },
        created() {
            if (this.$gate.isAdmin()){
                this.loadUser();
            }
        }
    }
</script>
