<template>
    <app-layout title="Dashboard">
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                교과목 목록
            </h2>
        </template>
        <div class="text-center">

                <button v-if="current_page!=1" @click="[current_page+=-1,showSubject()]" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded center"> &lt; </button>
                <button v-for="i in last_page" :key="i" @click="[current_page=i,showSubject()]" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded center"> <div v-if="current_page != i">{{ i }} </div></button>
                <button v-if="current_page!=last_page" @click="[current_page+=1,showSubject()]" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded center"> &gt; </button>

            <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
                <div v-for="subject in subjects.data" :key="subject" class="rounded overflow-hidden shadow-lg" >
                    <div>
                            과목이름 :{{ subject.subject_name }}<br>
                            학점 : {{ subject.subject_num }}<br>
                            과목 설명 : {{ subject.subject_comment }}<br>
                            <button v-on:click="[subject_value = subject,ModalShow()]" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded center">상세보기</button>
                    </div>
                </div>
            </div>
              <dialog-modal :show="showModal">
                    <template #content>
                            <detail-subject @close="close" v-bind:subject_value="subject_value"></detail-subject>
                    </template>
            </dialog-modal>
        </div>

    </app-layout>
<div>


</div>
</template>
<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import DetailSubject from './DetailSubject.vue'
    import DialogModal from '../../Jetstream/DialogModal.vue'
export default {
    components:{
        AppLayout,
        DialogModal,
        DetailSubject,
    },
    data(){
        return{
            subjects:[],
            page_data:[],
            current_page:1,
            last_page:0,
            first_page:1,
            showModal:false,
            subject_value:[]
        }
    },
    methods:{
        showSubject(){
            axios.post("/show/subject/?page="+this.current_page)
            .then(response =>{
                console.log(response)
                this.subjects=response.data
                this.currentPage=response.data.current_page
                this.last_page=response.data.last_page
                this.first_page=response.first_page
            })
        },
        ModalShow(){
            this.showModal=true
            console.log(this.subject_value)
        },
        close(){
            this.showModal=false
            this.showSubject()
        }
    },
    mounted(){
        this.showSubject()
    },

}
</script>
