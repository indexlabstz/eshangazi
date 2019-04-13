<script>
    export default {
        data() {
            return {
                creating: false,
                category_id: this.category.id,
                created_by: this.user,
                items: [],
                item: {}
            };
        },

        props: ['category', 'user'],

        created() {
            this.fetch();
        },

        methods: {
            fetch() {
                axios.get('/api/categories/' + this.category.id)
                    .catch(error => {
                        console.log(error.response.data);
                    }).then(({data}) => {
                        this.items = data.items.reverse();
                    });
            },

            new_item() {
                this.creating = this.creating !== true;
            },

            store(event) {
                event.preventDefault();

                axios.post('/api/items', {
                    title: this.item.title,
                    description: this.item.description,
                    display_title: this.item.title,
                    item_category_id: this.category.id,
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

            publish() {

            },

            clear() {
                this.item.title = '';
                this.item.description = '';
                this.item.display_title = '';
            }
        }
    }
</script>