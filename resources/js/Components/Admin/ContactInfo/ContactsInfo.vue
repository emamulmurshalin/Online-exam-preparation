<template>
    <div class="container">
        <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
                <h3 class="card-title">Contact info</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="example1_length">
                                <label>Show <select name="example1_length" aria-controls="example1"
                                                    class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option></select> entries</label>
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
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Phone</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Email</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Message</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr role="row" class="even" v-for="contact in contacts.data" :key="contact.id">
                                    <td class="sorting_1" tabindex="0">{{contact.id}}</td>
                                    <td>{{contact.name}}</td>
                                    <td>{{contact.phone}}</td>
                                    <td>{{contact.email}}</td>
                                    <td>{{contact.message}}</td>
                                    <td>
                                        <a href="#" @click.preven="deleteContact(contact.id)">
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
                <pagination :data="contacts" @pagination-change-page="loadContact">
                    <span slot="prev-nav">&lt; Previous</span>
                    <span slot="next-nav">Next &gt;</span>
                </pagination>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

</template>

<script>
    export default {
        name: "ContactInfo",
        data() {
            return {
                search: '',
                contacts: {},
            }
        },
        methods:{
            searchIt(){
                this.axios.get('/find-user?search=' + this.search)
                    .then(response => {
                        this.contacts = response.data;
                    }).catch((error) => {

                });
            },
            loadContact(page = 0){
                this.axios.get('/contact-info?page=' + page)
                    .then(response => {
                        this.contacts = response.data;
                    }).catch((error) => {

                });
            },
            deleteContact(id){
                swal.fire({
                    title: 'Are you sure',
                    text: "This content will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.axios.delete(`/contact-info/${id}`)
                            .then((response) => {
                                this.loadContact();
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
        },
        created() {
            if (this.$gate.isAdmin()){
                this.loadContact();
            }
        }
    }
</script>