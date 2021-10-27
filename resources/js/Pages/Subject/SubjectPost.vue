<template>

    <app-layout title="Dashboard">
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                교과목 등록
            </h2>
        </template>

    <div class="text-center">
        <div>과목이름</div>
        <input type="text" v-model="title">
        <div>학점</div>
        <input type="text" v-model="num">
        <div>과목설명</div>
        <input type="text" v-model="comment"><br>
        <button @click="SubjectPost" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded center">수강과목 입력</button>
    </div>

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
           comment:"",
           num:0,
           title:"",
        }
    },
    methods:{
        SubjectPost(){
            axios.post("/post/subject",{
                "comment":this.comment,
                "num":this.num,
                "title":this.title

            }).then(res=>{
                alert("등록 되었습니다.")
                this.comment=""
                this.num=""
                this.title=""
                console.log(res)
            }).catch(err=>{
                alert("등록 실패")
            })
        }
    }

}
</script>
