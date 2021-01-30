require('./bootstrap');

import Vue from 'vue'
import moment from 'moment'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { Form, HasError, AlertError } from 'vform'

import Gate from './Gate'
Vue.prototype.$gate = new Gate(window.user);

import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer)
        toast.addEventListener('mouseleave', swal.resumeTimer)
    }
});
window.toast = toast;

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));

import VueRouter from 'vue-router'
Vue.use(VueRouter);

/*----Start vue-progressbar*/
import VueProgressBar from 'vue-progressbar'
const options = {
    color: '#31fa10',
    failedColor: '#ff2011',
    thickness: '5px',
    transition: {
        speed: '0.5s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}
Vue.use(VueProgressBar, options)
/*----Start vue-progressbar*/

// import { InertiaApp } from '@inertiajs/inertia-vue';
// import { InertiaForm } from 'laravel-jetstream';
// import PortalVue from 'portal-vue';
//
// Vue.mixin({ methods: { route } });
// Vue.use(InertiaApp);
// Vue.use(InertiaForm);
// Vue.use(PortalVue);

//Users
import Users from './Components/Admin/Users/Users.vue';
import Dashboard from './Components/Admin/Dashboard/Dashboard.vue';
import ContactInfo from './Components/Admin/ContactInfo/ContactsInfo.vue';
import BlogPost from './Components/Admin/Blog/Blogs.vue';
import AddBlogPost from './Components/Admin/Blog/AddPost.vue';
import Profile from './Components/Admin/Profile/Profile.vue';
import Quiz from './Components/Admin/Quiz/QuizList.vue';
import AddQuiz from './Components/Admin/Quiz/AddQuiz.vue';
import AddQuizAnswer from './Components/Admin/Quiz/AddQuizAnswer.vue';
import AddQuizQuestion from './Components/Admin/Quiz/AddQuizQuestion.vue';
import AddPreviousQuestion from './Components/Admin/PreviousQuestion/AddPreviousQuestion.vue';
import ViewPreviousQuestion from './Components/Admin/PreviousQuestion/ShowQuestion.vue';
import ExamContactUs from './Components/FrontEnd/Contact/ContactUs.vue';
import QuestionShow from './Components/FrontEnd/Question/QuestionShow.vue';
import ModelTest from './Components/FrontEnd/Quiz/ModelTest.vue';
import Login from './Components/FrontEnd/Register/Login.vue';
import Registration from './Components/FrontEnd/Register/Registration.vue';
import ShowJobExam from './Components/Admin/JobExamInfo/ShowJobExamInfo.vue';
import AddJobExam from './Components/Admin/JobExamInfo/AddJobExamInfo';

let routes = [
    { path: '/users/list/view', component: Users },
    { path: '/dashboard', component: Dashboard },
    { path: '/users/contact-info', component: ContactInfo },
    { path: '/users/blog-post', component: BlogPost },
    { path: '/users/add-post', component: AddBlogPost },
    { path: '/users/profile', component: Profile },
    { path: '/quiz/list/view', component: Quiz },
    { path: '/add-quiz', component: AddQuiz },
    { path: '/add-quiz-answer', component: AddQuizAnswer },
    { path: '/add-quiz-question', component: AddQuizQuestion },
    { path: '/add-previous-question', component: AddPreviousQuestion },
    { path: '/show-question', component: ViewPreviousQuestion },
    { path: '/exam/contact-us', component: ExamContactUs },
    { path: '/exam/question', component: QuestionShow },
    { path: '/exam/model-test', component: ModelTest },
    { path: '/user/login', component: Login },
    { path: '/user/registration', component: Registration },
    { path: '/show-exam-info', component: ShowJobExam },
    { path: '/add-exam-info', component: AddJobExam },
];

Vue.use(VueAxios, axios);

let router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

//Date and text globaly change /////
Vue.filter('textUppercase', function (text) {
    if (!text) return ''
    text = text.toString()
    return text.charAt(0).toUpperCase() + text.slice(1)
});
Vue.filter('localDate', function (date) {
    return moment(date).format('MMMM Do YYYY');
});

/////////////////
Vue.component(
    'dashboard-show',
    require('./Components/Admin/Dashboard/Dashboard').default
);
Vue.component(
    'show-user',
    require('./Components/Admin/Users/Users').default
);
Vue.component(
    'add-user',
    require('./Components/Admin/Users/UserModal').default
);
Vue.component(
    'contact-info',
    require('./Components/Admin/ContactInfo/ContactsInfo').default
);
Vue.component(
    'blog-post',
    require('./Components/Admin/Blog/Blogs').default
);
Vue.component(
    'add-blog-post',
    require('./Components/Admin/Blog/AddPost').default
);
Vue.component(
    'user-profile',
    require('./Components/Admin/Profile/Profile').default
);
Vue.component(
    'not-found',
    require('./Components/Admin/NotFound').default
);
Vue.component(
    'quiz-list-view',
    require('./Components/Admin/Quiz/QuizList').default
);
Vue.component(
    'add-new-quiz',
    require('./Components/Admin/Quiz/AddQuiz').default
);
Vue.component(
    'add-quiz-answer',
    require('./Components/Admin/Quiz/AddQuizAnswer').default
);
Vue.component(
    'add-quiz-question',
    require('./Components/Admin/Quiz/AddQuizQuestion').default
);
Vue.component(
    'add-previous-question',
    require('./Components/Admin/PreviousQuestion/AddPreviousQuestion').default
);
Vue.component(
    'show-previous-question',
    require('./Components/Admin/PreviousQuestion/ShowQuestion').default
);

Vue.component(
    'show-job-info',
    require('./Components/Admin/JobExamInfo/ShowJobExamInfo').default
);
Vue.component(
    'add-job-info',
    require('./Components/Admin/JobExamInfo/AddJobExamInfo').default
);

//Front end vue
Vue.component(
    'exam-contact-us',
    require('./Components/FrontEnd/Contact/ContactUs').default
);

Vue.component(
    'exam-question',
    require('./Components/FrontEnd/Question/QuestionShow').default
);

Vue.component(
    'app-model-test',
    require('./Components/FrontEnd/Quiz/ModelTest').default
);

Vue.component(
    'app-login',
    require('./Components/FrontEnd/Register/Login').default
);
Vue.component(
    'app-registration',
    require('./Components/FrontEnd/Register/Registration').default
);

const app = new Vue({
    el: '#app',
    router,
});

// new Vue({
//     render: (h) =>
//         h(InertiaApp, {
//             props: {
//                 initialPage: JSON.parse(app.dataset.page),
//                 resolveComponent: (name) => require(`./Pages/${name}`).default,
//             },
//         }),
// }).$mount(app);
