<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Sample Crud</div>

                    <div class="card-body">

                        <div class="input-group">
                            <input type="text" class="form-control" v-model="cruds.name" @keydown.enter="create" placeholder="Name" >
                            <input type="text" class="form-control" v-model="cruds.address" @keydown.enter="create" placeholder="address" >
                            <input type="text" class="form-control" v-model="cruds.phone" @keydown.enter="create" placeholder="Phone">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success" name="button" @click="create"> Add </button>
                            </span>
                        </div>
                        <!-- template for the modal component -->



                        <br>
                        <div class="crud-list">
                            <ul class="list-unstyled">
                                <li v-for="cruds in crud" :key='cruds.id' :class="{ done: cruds.completed }">
                                    <div class="checkbox">
                                        <div class="row">
                                            <label class="col-md-9">
                                                <!-- <input type="checkbox" v-model="cruds.completed" @click="done(cruds)"> -->
                                                 {{ cruds.name }} - {{ cruds.address }} - {{ cruds.name }}
                                             </label>
                                            <div class="text-right col-md-3">
                                                <button @click.prevent="edit(cruds)" class="btn btn-sm btn-success">Edit</button >
                                                <button @click.prevent="remove(cruds)" class="btn btn-sm btn-danger">Hapus</button >
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            this.fectData() ;
        },
        data(){
            return {
                crud: [],
                cruds : {
                }
            }
        },
        methods: {
            fectData(){
                axios.get('/api/crud').then((res) => {
                    this.crud = res.data
                })
                .catch((err) => {
                    console.log(err)
                })
            },
            create(){
                axios.post('/api/crud', this.cruds)
                .then((res) =>{
                    this.crud.push(res.data)
                    this.cruds.name = ''
                    this.cruds.phone = ''
                    this.cruds.address = ''
                })
                .catch((err) => {
                    console.log(err)
                })
            },
            // done(cruds) {
            //     axios.put(`api/crud/${cruds.id}`, {
            //         completed: !cruds.completed
            //     })
            //     .then((res) => {
            //         console.log('Name Already Checked')
            //     })
            //     .catch((err) => {
            //         console.log(err)
            //     })
            // },
            edit(cruds) {
                axios.get(`api/crud/${cruds.id}/edit`).then((res) => {
                    this.cruds.name = res.data.name
                })
                .catch((err) => {
                    console.log(err)
                })
            },
            remove(cruds) {
                axios.delete(`api/crud/${cruds.id}`)
                .then((res) => {
                    const crudsIndex = this.crud.indexOf(cruds)
                    this.crud.splice(crudsIndex, 1)
                })
                .catch((err) => {
                    console.log(err)
                })
            }
        }
    }
</script>
<style >
    .done label{
        color : red ;
    }
</style>
