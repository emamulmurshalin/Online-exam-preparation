<template>
    <li class="nav-item dropdown" v-if="dataLoaded">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">{{ contacts.length }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media" v-for="contact in contacts">
                    <img :src="getImage()" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            {{ contact.name }}
                            <span @click.prevent="readMessage(contact.id)" class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">{{ contact.message }}</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{contact.created_at | localDate}}</p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
<!--            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>-->
        </div>
    </li>
</template>

<script>
export default {
name: "NavBarMessage",
    data(){
        return{
            contacts: {},
            dataLoaded: false,
            form: new Form({
                status_id: 6
            })
        }
    },
    mounted() {
        this.getTotalMessage();
    },
    methods:{
        getTotalMessage(){
            this.axios.get('/total-message')
                .then(response => {
                    this.contacts = response.data;
                    this.dataLoaded = true;
                }).catch((error) => {

            });
        },
        getImage(){
            return '/img/profile/default.png';
        },
        readMessage(id){
            this.axios.patch(`/contact-info/${id}`, this.form)
                .then((response) => {
                    this.getTotalMessage();
                    toast.fire({
                        icon: 'success',
                        title: 'Message read by owner'
                    });
                }).catch(()=>{

            });
        }
    }
}
</script>
