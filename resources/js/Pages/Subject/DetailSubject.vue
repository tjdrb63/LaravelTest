<template>
    <div>상세 보기</div>
    <div class="mb-6" >
        <div class="text-center">
            과목이름 :<input type="text" v-model="name"><br>
            학점 :<input type="text" v-model="num"><br>
            과목설명 :<input type="text" v-model="comment"><br>

            <p class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">최초생성일:   {{ subject_value.created_at }}<br></p>
            <p class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"> 수정된 날짜: {{ subject_value.updated_at }}</p>
        </div>
        <div class="flex items-center justify-between">

            <button @click="checkSubject" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    신청하기
            </button>

            <button @click="close" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    나가기
            </button>
            <button @click="updateSubject" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    수정하기
            </button>

            <button @click="deleteSubject" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    삭제하기
            </button>
        </div>
    </div>


</template>
<script>
export default {
    props:['subject_value'],
    data(){
        return{
            name:this.subject_value.subject_name,
            num:this.subject_value.subject_num,
            comment:this.subject_value.subject_comment
        }
    },
    methods:{
        close(){
            this.$emit("close");
        },
        updateSubject(){
            axios.post('update/subject',{
                "subject_id":this.subject_value.id,
                "name":this.name,
                "num":this.num,
                "comment":this.comment,
            }).then(res=>{
                console.log(res)
                alert("수정되었습니다")
            })
        },
        deleteSubject(){
            axios.post('delete/subject',{
                "subject_id":this.subject_value.id
            }).then(
                this.$emit("close")
            )
        },
        checkSubject(){
            axios.post('check/subject/'+this.subject_value.id)
            .then(res=>{
                console.log(res.data)
                alert(res.data);
            })
        }
    }
}
</script>
