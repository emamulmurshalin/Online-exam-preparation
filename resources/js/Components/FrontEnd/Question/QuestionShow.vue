<template>
    <div class="container-fluid">
        <div class="card bg-color">
            <div class="card-header" style="padding: 10px;">
                <h3 class="card-title">Show question</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row" style="padding-top: 10px; padding-bottom: 15px;">
                        <div class="col-sm-2" align="center">
                            <model-list-select :list="typeData"
                                               v-model="form.question_type"
                                               option-value="type"
                                               option-text="type"
                                               placeholder="Select question type">
                            </model-list-select>
                        </div>
                        <div class="col-sm-2" align="center">
                            <model-list-select :list="yearData"
                                               v-model="form.question_year"
                                               option-value="year"
                                               option-text="year"
                                               placeholder="Select question year">
                            </model-list-select>
                        </div>
                        <div class="col-sm-2" align="center">
                            <button type="submit" class="btn btn-info pr-4 pl-4"
                                    @click.prevent="showFilterData">
                                Filter Data
                            </button>
                        </div>
                        <div class="col-sm-2" align="center">
                            <input type="search" v-model="search"
                                   @keyup.enter="searchIt" class="form-control form-control-sm"
                                   placeholder="Search here" aria-controls="example1">
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
import { ModelListSelect  } from 'vue-search-select'
export default {
    components: {
        ModelListSelect
    },
        name: "QuestionShow",
        data(){
            return{
                form: new Form({
                    question_type: '',
                    question_year: '',

                }),
                questions: {},
                search: '',
                typeData: [],
                yearData: [],
            }
        },
        mounted(){
            this.getAllQuestion();
            this.getTypes();
            this.getYears();
        },
        methods:{
            searchIt(){
                console.log('search');
            },
            getTypes(){
                this.axios.get('/get-types')
                    .then((response) => {
                        this.typeData = response.data;
                    }).catch(()=>{

                });
            },
            getYears(){
                this.axios.get('/get-years')
                    .then((response) => {
                        this.yearData = response.data;
                    }).catch(()=>{

                });
            },
            showFilterData(){
                this.getAllQuestion();
            },
            getAllQuestion(page = 0){
                this.axios.get('/previous-question?page=' + page +
                    '&type=' + this.form.question_type + '&year=' + this.form.question_year)
                    .then(response => {
                        this.questions = response.data;
                    }).catch((error) => {

                });
            }
        }
    }
</script>
<style scoped>
.bg-color {
    width: 100%;
    background-color: #F5F5F5;
    margin-top: 10px;
    margin-bottom: 10px;
}

</style>

