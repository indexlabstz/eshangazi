@extends('layouts.dashboard')

@section('content')
    <question-create :user="{{ auth()->user() }}" inline-template>
        <div class="w-full lg:ml-376">
            <div class="flex px-three-five-px pt-12 pb-6">
                <main class="min-h-full w-full">
                    <div class="flex flex-col flex-1">
                        <div class="p-4 border-dashed border border-proton-grey-opacity-80 rounded text-solstice-blue group m-4 flex-1">
                            <h3 class="flex items-center justify-between flex-wrap mb-4 -mt-1 -mx-1 text-xs font-normal py-0 px-4">
                                <span>
                                    <span class="inline-block mx-1 leading-loose cursor-pointer font-semibold text-yesayasoftware">
                                        Questions
                                    </span>

                                    <a href="#">
                                        <span class="inline-block mx-1 leading-loose cursor-pointer text-yesayasoftware-grey">
                                            View Questions
                                        </span>
                                    </a>
                                </span>

                                <button @click="store" class="flex items-center align-content-center">
                                    <span class="flex w-4 h-4 mr-6 items-center justify-center fill-current">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 17" class="h-full">
                                            <path d="M8.5,17A.54.54,0,0,1,8.28,17l-8-4a.5.5,0,1,1,.44-.9L8.5,15.94l7.78-3.89a.5.5,0,0,1,.44.9l-8,4A.54.54,0,0,1,8.5,17Zm0-4A.54.54,0,0,1,8.28,13l-8-4a.5.5,0,1,1,.44-.9L8.5,11.94l7.78-3.89a.5.5,0,0,1,.44.9l-8,4A.54.54,0,0,1,8.5,13Zm0-4A.54.54,0,0,1,8.28,9l-8-4a.5.5,0,0,1,0-.9l8-4a.49.49,0,0,1,.44,0l8,4a.5.5,0,0,1,0,.9l-8,4A.54.54,0,0,1,8.5,9ZM1.62,4.5,8.5,7.94,15.38,4.5,8.5,1.06Z"></path>
                                        </svg>
                                    </span>

                                    <span class="inline-block mx-1 leading-loose cursor-pointer text-yesayasoftware-grey">
                                        Add New
                                    </span>
                                </button>
                            </h3>

                            <div>
                                <form>
                                    <div class="flex sm:flex-row flex-col -mx-2">
                                        <div class="flex-1 py-0 px-4">
                                            <input autocapitalize="none"
                                                   autocomplete="off"
                                                   autocorrect="off"
                                                   class="flex-1 w-full bg-moon-grey rounded mx-2 mb-4 py-4 px-6 text-telluric-blue shadow-none outline-none"
                                                   id="question"
                                                   placeholder="What's the question?"
                                                   spellcheck="false"
                                                   type="text"
                                                   name="question"
                                                   v-model="form.question">
                                        </div>

                                        <div class="flex-1 py-0 px-4">
                                            <div class="flex items-center flex-1 bg-moon-grey rounded py-4 px-6 mx-2 mb-4">
                                                <select class="w-full bg-moon-grey text-telluric-blue appearance-none shadow-none outline-none"
                                                        id="question_category_id"
                                                        name="question_category_id"
                                                        v-model="form.question_category_id">
                                                    <option selected>Category for this question...</option>

                                                    <option v-for="category in categories" :value="category.id">@{{ category.name }}</option>

                                                    <option>
                                                        Add New
                                                    </option>
                                                </select>

                                                <div class="flex-no-grow flex-no-shrink h-1 text-solstice-blue opacity-75 fill-current">
                                                    <svg class="block h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 8">
                                                        <path d="M7,8a1,1,0,0,1-.71-.29l-6-6A1,1,0,0,1,1.71.29L7,5.59,12.29.29a1,1,0,1,1,1.42,1.42l-6,6A1,1,0,0,1,7,8Z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="flex justify-center mt-5">
                                        <div class="block h-px flex-grow bg-telluric-blue-opacity-10"></div>
                                    </div>
                                </form>

                                <div class="py-0 px-4 mt-5">
                                    <h4 class="subtitle" v-cloak>There are @{{ questions.length }} questions so far...</h4>

                                    <div>
                                        <ul class="list-reset" v-if="questions.length > 0">
                                            <a href="#" class="hover:no-underline text-grey-darkest" v-for="(question, index) in questions" @click="openAnswerForm(index)">
                                                <li class="mb-4 pb-4 border-b">
                                                    <div>
                                                        <div>
                                                            <div class="flex items-center justify-between mb-2 -mt-1 -mx-1 text-xs font-normal">
                                                                <div class="flex w-5/6">
                                                                    <div class="flex items-center justify-center h-three-five w-three-five mr-4 flex-no-grow flex-no-shrink">
                                                                        <img src="/img/sample-ad.jpg" class="h-auto max-h-12 w-auto">
                                                                    </div>

                                                                    <div class="w-full">
                                                                        <h5 class="mb-2">
                                                                            <span class="text-cosmos-black text-sm font-normal">
                                                                                @{{ question.question }}
                                                                            </span>
                                                                        </h5>

                                                                        <p class="flex items-center align-content-center justify-between">
                                                                            <span class="text-cosmos-black-opacity-70 text-xs ais-Snippet" v-if="question.answers.length > 0">
                                                                                Answer: <span :class="correctAnswer(ans.correct)" v-for="(ans, i) in question.answers">@{{ ans.answer }}</span>
                                                                            </span>

                                                                            <span class="text-cosmos-black-opacity-70 text-xs ais-Snippet" v-else>No answers yet</span>

                                                                            <span class="text-cosmos-black-opacity-70 text-xs ais-Snippet">
                                                                                @{{ question.creator.name }}
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="flex items-center align-content-center justify-end w-1/6">
                                                                    <span class="flex w-4 h-4 mr-6 items-center justify-center fill-current" @click="closeAnswerForm(index)">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 17" class="h-full">
                                                                            <path d="M8.5,17A.54.54,0,0,1,8.28,17l-8-4a.5.5,0,1,1,.44-.9L8.5,15.94l7.78-3.89a.5.5,0,0,1,.44.9l-8,4A.54.54,0,0,1,8.5,17Zm0-4A.54.54,0,0,1,8.28,13l-8-4a.5.5,0,1,1,.44-.9L8.5,11.94l7.78-3.89a.5.5,0,0,1,.44.9l-8,4A.54.54,0,0,1,8.5,13Zm0-4A.54.54,0,0,1,8.28,9l-8-4a.5.5,0,0,1,0-.9l8-4a.49.49,0,0,1,.44,0l8,4a.5.5,0,0,1,0,.9l-8,4A.54.54,0,0,1,8.5,9ZM1.62,4.5,8.5,7.94,15.38,4.5,8.5,1.06Z"></path>
                                                                        </svg>
                                                                    </span>

                                                                    <span class="inline-block mx-1 leading-loose cursor-pointer text-yesayasoftware-grey">
                                                                        Level @{{ question.difficulty }}
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <form :id="index" class="form mt-5" :ref="'form' + index" style="display:none">
                                                                <div class="flex sm:flex-row flex-col -mx-2">
                                                                    <div class="flex-1 py-0 px-4">
                                                                        <input autocapitalize="none"
                                                                               autocomplete="off"
                                                                               autocorrect="off"
                                                                               class="flex-1 w-full bg-moon-grey rounded mx-2 mb-4 py-4 px-6 text-telluric-blue shadow-none outline-none"
                                                                               id="answer"
                                                                               placeholder="What's the answer?"
                                                                               spellcheck="false"
                                                                               type="text"
                                                                               name="answer"
                                                                               v-model="answer.answer">
                                                                    </div>

                                                                    <div class="flex-1 py-0 px-4">
                                                                        <div class="flex items-center flex-1 rounded py-4 px-6 mx-2 mb-1">
                                                                            <label class="md:w-2/3 block text-grey font-bold">
                                                                                <input class="mr-2 leading-tight" v-model="answer.correct" type="checkbox">

                                                                                <span class="text-sm" >
                                                                                    Correct?
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="flex-1 py-0 px-4">
                                                                        <div class="flex items-center justify-end py-4 px-6 mx-2">
                                                                            <button class="flex-no-shrink border-transparent border-4 text-teal hover:text-teal-darker text-sm py-1 px-2 rounded"
                                                                                    type="button"
                                                                                    @click="addAnswer(index, question.id)">
                                                                                Add
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </li>
                                            </a>
                                        </ul>

                                        <span class="text-cosmos-black text-sm font-normal" v-else>
                                            No data to display at the moment.
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mx-3 flex sm:flex-row flex-col">
                        <div class="p-4 border-dashed border border-proton-grey-opacity-80 rounded text-solstice-blue group m-1 h-104 flex-1">
                            <h3 class="flex items-center justify-between flex-wrap mb-4 -mt-1 -mx-1 text-xs font-normal">
                                <span>
                                    <span class="inline-block mx-1 leading-loose text-yesayasoftware-grey">
                                        More questions
                                    </span>
                                </span>
                            </h3>

                            <div>
                                <div class="">
                                    <div class="ais-Pagination">
                                        {{--{{ $questions->links() }}--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </question-create>
@endsection