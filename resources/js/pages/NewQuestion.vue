<script>
    export default {
        props: ['user'],

        data () {
            return {
                form: {},
                questions: [],
                categories: [],
                open_form: false,
                answer: {
                    answer: '',
                    correct: false,
                    question_id: '',
                    created_by: ''
                },
                answers: [],
                prevIndex: -1
            };
        },

        created () {
            this.resetForm();
            this.loadCategories();
            this.getQuestions();
        },

        methods: {
            loadCategories() {
                let url = `/api/question_categories/`;

                axios.get(url).catch(error => {
                    flash(error.response.data, 'danger');
                }).then(({data}) => {
                    this.categories = data;
                });
            },

            openAnswerForm(index) {
                if (this.prevIndex !== -1)
                    $( this.$refs['form' + this.prevIndex] ).toggle();

                $( this.$refs['form' + index] ).toggle();

                this.prevIndex = index;
            },

            closeAnswerForm(index) {
                $( this.$refs['form' + index] ).toggle();
            },

            getQuestions() {
                let url = `/api/questions/`;

                axios.get(url).catch(error => {
                    flash(error.response.data, 'danger');
                }).then(({data}) => {
                    this.questions = data.data.slice().reverse();
                });
            },

            store () {
                this.form.type = 'truth';
                this.form.difficulty = 'easy';
                this.form.created_by = this.user.id;

                let uri = `/api/questions/`;

                axios.post(uri, this.form).then(() => {
                    this.getQuestions();
                    this.form = {};

                    flash('Your question has been created.');
                });
            },

            addAnswer (index, question_id) {
                this.answer.question_id = question_id;
                this.answer.created_by = this.user.id;

                let uri = `/api/questions/${question_id}/answer`;

                axios.post(uri, this.answer).then(({data}) => {
                    this.getQuestions();
                    this.resetForm();

                    flash('Your answer has been saved.');
                });
            },

            correctAnswer(correct) {
                if (correct)
                    return "bg-green-light p-1 rounded mr-2";
                else
                    return "bg-grey-light p-1 rounded mr-2";
            },

            resetForm () {
                this.form = {
                    question: '',
                    question_category_id: '',
                    created_by: ''
                };

                this.answer = {
                    answer: '',
                    correct: false,
                    question_id: '',
                    created_by: ''
                };

                this.editing = false;
            }
        }
    }
</script>