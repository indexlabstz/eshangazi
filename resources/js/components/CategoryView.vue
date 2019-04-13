<script>
    export default {
        data() {
            return {
                creating: false,
                categories: [],
                category: {},
                created_by: this.user,
            }
        },

        props: ['user'],

        created() {
            this.fetch();
        },

        methods: {
            fetch() {
                axios.get('/api/categories')
                    .catch(error => {
                        console.log(error.response.data);
                    }).then(({data}) => {
                    this.categories = data.reverse();
                });
            },

            new_category() {
                this.creating = this.creating !== true;
            },

            store(event) {
                event.preventDefault();

                axios.post('/api/categories', {
                    name: this.category.name,
                    description: this.category.description,
                    display_title: this.category.name,
                    created_by: this.created_by
                }).catch(error => {
                    console.log(error.response.data);
                }).then(({data}) => {
                    this.fetch();
                    this.clear();
                    console.log("Successfully added");

                    this.creating = false;
                });
            },

            clear() {
                this.category.name = '';
                this.category.description = '';
                this.category.display_title = '';
            }
        }
    }
</script>