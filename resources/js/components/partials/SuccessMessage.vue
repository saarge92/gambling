<template>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Успех!</h5>
                    <button v-on:click="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ message }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="closeModal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SuccessMessage",
    props: ["message"],
    methods:{
        closeModal(){
            document.getElementById("exampleModal").style.display = "none"
            document.getElementById("exampleModal").className += document.getElementById("exampleModal").className.replace("show", "")
        }
    }
}
</script>

<style scoped>

</style>
