<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Show question</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
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
                                    <th>ID</th>
                                    <th>Qquestion title</th>
                                    <th>Year</th>
                                    <th>Type</th>
                                    <th>Action</th>
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
            <!-- /.card-body -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "QuestionShow",
        data(){
            return{
                questions: {},
                search: '',
            }
        },
        created(){
            this.getAllQuestion();
        },
        methods:{
            searchIt(){
                console.log('search');
            },
            getAllQuestion(page = 0){
                this.axios.get('/previous-question?page=' + page)
                    .then(response => {
                        this.questions = response.data;
                    }).catch((error) => {

                });
            }
        }
    }
</script>
