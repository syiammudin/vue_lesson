<template lang="html">
    <div class="row justify-content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <button type="button" @click="create()" class="btn btn-primary btn-sm">Add Data</button>
                </div>
                <div class="input-group col-md-4">
                    <input type="text" v-model="search" class="form-control" >
                </div>
            </div>
        </div>
        <table class="table table-sm ">
            <tr>
                <th>No</th>
                <th>Title </th>
                <th>Content</th>
                <th>Action</th>
            </tr>
            <tr v-for="(d , no ) in datas.data" :key="d.id">
                <td>{{ no + 1 }}</td>
                <td>{{ d.title }}</td>
                <td>{{ d.content }}</td>
                <td>
                    <button type="button" @click.prevent="edit(d)" class="btn btn-sm btn-warning">Edit</button>
                    <button type="button" @click.prevent="deleted(d)" class="btn btn-sm btn-danger">X</button>
                </td>
                <input type="hidden" v-model="data.total">
                <input type="hidden" v-model="pages">
            </tr>
        </table>
        <pagination :data="datas" @pagination-change-page="ambilData"></pagination>


        <!-- untuk modal  -->
        <modal name="create" class="card" height="auto">
                <div class="card-header">
                    {{ input.id === undefined ? 'Add': 'Edit'}} Form data
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <label for="" class="col-md-3">Title</label>
                            <div class="col-md-9">
                                <input type="text" v-model="input.title" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="" class="col-md-3">Content</label>
                            <div class="col-md-9">
                                <input type="text" v-model="input.content" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm" @click.prevent="input.id === undefined ? save() : update(input) ">{{ input.id === undefined ? 'Save': 'Update'}} </button>
                </div>
        </modal>
    </div>
</template>

<script>
export default {
    mounted() {
        this.ambilData() ;
    },
    watch: {
        search(v) {
            this.ambilData()
        }
    },
    data(){
        return{
            datas : { }, data : [], input : {} , search : '',
            url: 'api/crud_modal'
        }
    },
    methods: {
        ambilData(page = 1){
            let params = {
                page: page,
                search: this.search
            }
            axios.get(this.url, {params: params}).then((res) =>{
                this.datas = res.data
                this.data = res.data
                this.pages = page
            })
            .catch((err) => {
                console.log(err)
            })
        },
        create(){
            this.$modal.show('create');
        },
        save(){
            axios.post('api/crud_modal', this.input).then((res) =>{
                this.input.title = ''
                this.input.content = ''
                this.ambilData()
                this.$modal.hide('create');
            })
            .catch((err) =>{
                console.log(err)
            })
        },
        edit(d){
            this.input = JSON.parse(JSON.stringify(d))
            this.$modal.show('create');
        },
        update(input){
            axios.put(`api/crud_modal/${input.id}`, this.input ).then((res) =>{
                this.input.title = ''
                this.input.content = ''
                this.ambilData(this.pages)
                this.$modal.hide('create')
            })
            .catch((err) =>{
                console.log(err)
            })
        },
        deleted(d){
            if (!confirm('Anda yakin?')) {
                return
            }

            axios.delete(`api/crud_modal/${d.id}`).then((res) =>{
                var hitung = (this.pages - 1) * 5
                var sisa = this.data.total - hitung
                if(sisa > 1){
                    var hal = this.pages
                }else{
                    var hal  = this.pages - 1
                }
                this.ambilData(hal)
            })
            .catch((err) =>{
                consol.log(err)
            })
        }
    }
}
</script>

<style lang="css" scoped>

</style>
