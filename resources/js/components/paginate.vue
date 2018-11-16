<template lang="html">
    <div class="card">
        <div class="card-header">
            Sample Pagination
        </div>
        <div class="card-body">
            <ul>
                <li v-for="post in laravelData.data" :key="post.id">{{ post.title }}</li>
            </ul>

            <pagination :data="laravelData" @pagination-change-page="getResults"></pagination>
        </div>
    </div>
</template>

<script>
export default {
    data() {
		return {
			// Our data object that holds the Laravel paginator data
			laravelData: {},
		}
	},

	mounted() {
		// Fetch initial results
		this.getResults();
	},

	methods: {
		// Our method to GET results from a Laravel endpoint
		getResults(page = 1) {
			axios.get('api/blog?page=' + page)
				.then(response => {
					this.laravelData = response.data;
				});
		}
	}

}
</script>

<style lang="css">
</style>
