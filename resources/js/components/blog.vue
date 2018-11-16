<template lang="html">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        Blog Using Vue
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" v-model="insert.title"  placeholder="Title" class="form-control">
                            <input type="text" v-model="insert.content" placeholder="Content" class="form-control">
                            <span v-if="!insert.id">
                                <button type="button" class="btn input-group-btn btn-primary" @click="save">Add</button>
                            </span>
                            <span v-else>
                                <button type="button" class="btn input-group-btn btn-primary" @click="update(insert)">Update</button>
                                <button type="button" class="btn input-group-btn btn-warning" @click="cancel()">Cancel</button>
                            </span>
                        </div>
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="(blog, n) in blogs.data" :key="blog.id">
                                <td>{{ n+1 }}</td>
                                <td>{{ blog.title }}</td>
                                <td>{{ blog.content }}</td>
                                <td>
                                    <button  @click.prevent="edit(blog)"  class="btn btn-sm btn-success"> Edit </button>
                                    <button  @click.prevent="hapus(blog, n+1)"  class="btn btn-sm btn-danger"> X </button>
                                </td>
                                <input type="hidden" v-model="hal">
                                <input type="hidden" v-model="data.total">
                            </tr>
                        </table>
                            <pagination :data="blogs" @pagination-change-page="ambilData"></pagination>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {

    mounted() {
        this.ambilData() ;
    },
    data(){
        return {
            blogs: {},
            data :[],
            insert : {
            }
        }
    },
    methods: {
        ambilData(page = 1){
            axios.get('api/blog?page=' + page).then((res) => {
                this.blogs = res.data
                this.data = res.data
                this.hal = page
            })
            .catch((err) =>{
                console.log(err)
            })
        },
        save(){
            axios.post('api/blog', this.insert).then((res) =>{
                // this.blogs.unshift(res.data)
                this.ambilData()
                this.insert.title = ''
                this.insert.content = ''
            })
            .catch((err) =>{
                console.log(err)
            })
        },
        edit(blog){
            this.insert = JSON.parse(JSON.stringify(blog))
        },
        update(insert){
            axios.put(`api/blog/${insert.id}`, this.insert).then((res) => {
                this.insert.id = 0
                this.insert.title = ''
                this.insert.content= ''
                this.ambilData(this.hal)
                // alert('update success')
            })
            .catch((err) => {
                console.log(err)
            })
        },
        hapus(blog, n){
            axios.delete(`api/blog/${blog.id}`).then((res) =>{
                var hitung = (this.hal - 1) * 5
                var sisa = this.data.total - hitung
                if(sisa > 1){
                    var hal = this.hal
                }else{
                    var hal  = this.hal - 1
                }
                this.ambilData(hal)
            })
            .catch((err) =>{
                console.log(err)
            })
        },
        cancel(){
            this.insert.title = ''
            this.insert.content = ''
            this.insert.id = 0
        }
    }
}
</script>

<style lang="css">
</style>
