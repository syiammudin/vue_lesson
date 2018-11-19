    <template lang="html">
        <div class="justify-content">
            <modal name="hello-world" class="card" height="auto">
                    <div class="card-header">
                        Form data
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <label for="" class="col-md-3">Title</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="" class="col-md-3">Content</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button >Save</button>
                    </div>
            </modal>
            <v-dialog />
            <modals-container/>
            <button type="button" @click="show">show</button>
        </div>
    </template>

    <script>
    export default {
        methods: {
          show () {
            this.$modal.show('hello-world');
          },
          hide () {
            this.$modal.hide('hello-world');
          }
        }
    }
    </script>

    <style lang="css">
    </style>
