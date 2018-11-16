<template lang="html">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        Blog Using Vue
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" v-model="insert.title"  placeholder="Title" class="form-control">
                            <input type="text" v-model="insert.content" placeholder="Content" class="form-control">

                            <button type="button" class="btn input-group-btn btn-primary" @click="!insert.id ? save() : update(insert)">{{ !insert.id ? 'Add ' : 'Update ' }}</button>
                        </div>
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="blog, n in blogs">
                                <td>{{ n+1 }}</td>
                                <td>{{ blog.title }}</td>
                                <td>{{ blog.content }}</td>
                                <td>
                                    <button  @click.prevent="edit(blog)"  class="btn btn-sm btn-success"> Edit </button>
                                    <button  @click.prevent="hapus(blog)"  class="btn btn-sm btn-danger"> X </button>
                                </td>
                            </tr>
                        </table>
                    </div>
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
            blogs: [],
            insert : {

            }
        }
    },
    methods: {
        ambilData(){
            axios.get('api/blog').then((res) => {
                this.blogs = res.data
            })
            .catch((err) =>{
                console.log(err)
            })
        },
        save(){
            axios.post('api/blog', this.insert).then((res) =>{
                this.blogs.unshift(res.data)
                this.insert.title = ''
                this.insert.content = ''
            })
            .catch((err) =>{
                console.log(err)
            })
        },
        edit(blog){
            this.insert = JSON.parse(JSON.stringify(blog))
            // axios.get(`api/blog/${blog.id}/edit`).then((res) => {
            //     this.insert = res.data
            // })
            // .catch((err) => {
            //     console.log(err)
            // })
        },
        update(insert){
            axios.put(`api/blog/${insert.id}`, this.insert).then((res) => {
                this.insert.id = 0
                this.insert.title = ''
                this.insert.content= ''
                this.ambilData()
                // alert('update success')
            })
            .catch((err) => {
                console.log(err)
            })
        },
        hapus(blog){
            axios.delete(`api/blog/${blog.id}`).then((res) =>{
                const BlogIndex = this.blogs.indexOf(blog)
                this.blogs.splice(BlogIndex, 1)
            })
            .catch((err) =>{
                console.log(err)
            })
        }
    }
}
</script>

<style lang="css">
</style>
