<template>
    <div class="container">
        <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
                <h3 class="card-title">Show question</h3>
                <div class="float-right">
                    <button @click.prevent="addQuestion" data-toggle="modal" class="btn btn-success">
                        Upload question
                        <i class="fas fa-question-circle"></i>
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
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Qquestion title</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Year</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Type</th>
                                    <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr role="row" class="even" v-for="question in questions.data" :key="question.id">
                                    <td class="sorting_1" tabindex="0">{{question.id}}</td>
                                    <td>{{question.question_title}}</td>
                                    <td>{{question.question_year.year}}</td>
                                    <td>{{question.question_type.type}}</td>
                                    <td>
                                        <a :href="'/exam/question/'+ question.id + '/preview'" target="_blank">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        /
                                        <a :href="'/exam/question/'+ question.id + '/download'" target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        /
                                        <a href="#" @click.prevent="editquestion(question.id)">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        /
                                        <a href="#" @click.preven="deleteQuestion(question.id)">
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
                <pagination :data="questions" @pagination-change-page="getAllQuestion">
                    <span slot="prev-nav">&lt; Previous</span>
                    <span slot="next-nav">Next &gt;</span>
                </pagination>
            </div>

            <app-previous-question-modal v-if="isModalActive"
                      v-bind:selected-url="editedUrl"
                      @close-modal="closeModal">
            </app-previous-question-modal>
            <!-- /.card-body -->
        </div>

        <div v-else class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <not-found></not-found>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShowQuestion",
        data(){
            return{
                questions: {},
                search: '',
                isModalActive: false,
                editedUrl: ''
            }
        },
        created(){
            this.getAllQuestion();
        },
        methods:{
            closeModal(modalId){
                this.isModalActive = false;
                $('#previousQuestionModal').modal('hide');
                this.editedUrl= '';
                this.getAllQuestion();
            },
            addQuestion(){
                this.isModalActive = true;
                setTimeout(()=> {
                    $('#previousQuestionModal').modal('show');
                })
            },
            searchIt(){
                this.axios.get('/find-previous-question?search=' + this.search)
                    .then(response => {
                        this.questions = response.data;
                    }).catch((error) => {

                });
            },
            showquestion(){

            },
            editquestion(id){
                this.editedUrl = `/previous-question/${id}`;
                this.isModalActive = true;
                setTimeout(()=> {
                    $('#previousQuestionModal').modal('show');
                })
            },
            deleteQuestion(id){
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
                        this.axios.delete(`/previous-question/${id}`)
                            .then((response) => {
                                this.getAllQuestion();
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
            getAllQuestion(page = 0){
                this.axios.get('previous-question?page=' + page)
                    .then(response => {
                        this.questions = response.data;
                    }).catch((error) => {

                });
            }
        }
    }
</script>
