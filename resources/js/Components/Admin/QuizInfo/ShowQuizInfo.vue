<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quiz marks List view</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="example1_length">
                                <label>Show <select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm">
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
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Marks</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Total marks</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Percentage</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">User name</th>
                                    <th v-if="$gate.isAdmin()" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr role="row" class="even" v-for="quizInfo in quizMarkInfo.data" :key="quizInfo.id">
                                    <td class="sorting_1" tabindex="0">{{quizInfo.id}}</td>
                                    <td>{{quizInfo.marks}}</td>
                                    <td>{{quizInfo.total_marks}}</td>
                                    <td>{{quizInfo.marks}} / {{quizInfo.total_marks}}</td>
                                    <td>{{quizInfo.user.first_name}} {{quizInfo.user.last_name}}</td>
                                    <td v-if="$gate.isAdmin()">
                                        <a href="#" @click.preven="deleteQuizInfo(quizInfo.id)">
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
                <pagination :data="quizMarkInfo" @pagination-change-page="loadQuizInfo">
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
    name: "ShowQuizInfo",
    data() {
        return {
            search: '',
            quizMarkInfo: {},
        }
    },
    methods:{
        searchIt(){
            this.axios.get('/find-quiz-mark?search=' + this.search)
                .then(response => {
                    this.quizMarkInfo = response.data;
                }).catch((error) => {

            });
        },
        loadQuizInfo(page = 0){
            this.axios.get('/quiz-mark?page=' + page)
                .then(response => {
                    this.quizMarkInfo = response.data;
                }).catch((error) => {

            });
        },
        deleteQuizInfo(id){
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
                    this.axios.delete(`/quiz-mark/${id}`)
                        .then((response) => {
                            this.loadQuizInfo();
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
    mounted() {
        this.loadQuizInfo();
    }
}
</script>
