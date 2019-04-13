<script>
    export default {
        data() {
            return {
                creating: false,
                items: [],
                child: {},
                created_by: this.user,
            }
        },

        props: ['item', 'user'],

        created() {
            this.fetch();
        },

        methods: {
            fetch() {
                axios.get('/api/items/' + this.item.id)
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
                    title: this.child.title,
                    description: this.child.description,
                    display_title: this.child.title,
                    item_category_id: this.item.item_category_id,
                    item_id: this.item.id,
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
                this.child.title = '';
                this.child.description = '';
                this.child.display_title = '';
            }
        }
    }
</script>