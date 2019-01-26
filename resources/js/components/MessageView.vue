<script>
	export default {
		data() {
			return {
				creating: false,
				title: null,
				description: null,
				message_id: this.message.id,
				created_by: this.user,
				messages: []
			};
		},

        props: ['message', 'user'],

        created() {
            this.fetch();
        },

        methods: {
            fetch() {
                axios.get('/api//messages/details/' + this.message.id).catch(error => {
                    console.log(error.response.data);
                }).then(({data}) => {
                    this.messages = data;
                });
            },

			new_message() {
				this.creating = true;
			},

			store(event) {
				event.preventDefault();

				axios.post('/api/messages/details', { 
                    title: this.title,
                    description: this.description,
                    message_id: this.message.id,
                    created_by: this.created_by 
                }).catch(error => {
                    console.log(error.response.data);
                }).then(({data}) => {
            		this.fetch();
                    console.log("Successfully added");

					this.creating = false;
                });
			},

			publish() {
				axios.post('/api/messages/publish' + this.message.id)
				.catch(error => {
                    console.log(error.response.data);
                }).then(({data}) => {
                    console.log("Successfully added");
                }); 
			}
		}
	}
</script>