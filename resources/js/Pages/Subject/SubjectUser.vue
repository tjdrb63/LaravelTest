<template>

    <app-layout title="Dashboard">
    <template #header>
            <div class="text-center">

                <!-- <button v-if="current_page!=1" @click="[current_page+=-1,showSubject()]" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded center"> &lt; </button>
                <button v-for="i in last_page" :key="i" @click="[current_page=i,showSubject()]" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded center"> <div v-if="current_page != i">{{ i }} </div></button>
                <button v-if="current_page!=last_page" @click="[current_page+=1,showSubject()]" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded center"> &gt; </button> -->
            </div>

            <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
                <div v-for="subject in subjects" :key="subject" class="rounded overflow-hidden shadow-lg" >
                    <div>
                            과목이름 :{{ subject.subject_name }}<br>
                            학점 : {{ subject.subject_num }}<br>
                            과목 설명 : {{ subject.subject_comment }}<br>
                            <button v-on:click="[subject_value = subject,ModalShow()]" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded center">상세보기</button>
                    </div>
                </div>
            </div>

        </template>
    </app-layout>
</template>
<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
export default {
    components:{
        AppLayout
    },
    data(){
        return{
            subjects:[]
        }
    },
    methods:{
        ShowUserList(){
            axios.post('show/user')
            .then(res=>{
                this.subjects=res.data
            })
        }
    }
    ,mounted(){
       this.ShowUserList()
    }

}
</script>
