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
                                                                            <span class="flex text-cosmos-black-opacity-70 text-xs ais-Snippet" v-if="question.answers.length > 0">
                                                                                <span :class="correctAnswer(ans.correct)" class="flex flex-col items-center justify-center fill-current" v-for="(ans, i) in question.answers">
                                                                                    <span class="flex-col">
                                                                                        <span class="mr-6">@{{ ans.answer }}</span>

                                                                                        <span @click.prevent="deleteAnswer(ans.id)">
                                                                                            <svg version="1.1" class="w-4 h-4" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                                                                viewBox="0 0 174.239 174.239" style="enable-background:new 0 0 174.239 174.239;" xml:space="preserve">
                                                                                                <g>
                                                                                                    <path d="M87.12,0C39.082,0,0,39.082,0,87.12s39.082,87.12,87.12,87.12s87.12-39.082,87.12-87.12S135.157,0,87.12,0z M87.12,159.305
                                                                                                        c-39.802,0-72.185-32.383-72.185-72.185S47.318,14.935,87.12,14.935s72.185,32.383,72.185,72.185S126.921,159.305,87.12,159.305z"></path>
                                                                                                    <path d="M120.83,53.414c-2.917-2.917-7.647-2.917-10.559,0L87.12,76.568L63.969,53.414c-2.917-2.917-7.642-2.917-10.559,0
                                                                                                        s-2.917,7.642,0,10.559l23.151,23.153L53.409,110.28c-2.917,2.917-2.917,7.642,0,10.559c1.458,1.458,3.369,2.188,5.28,2.188
                                                                                                        c1.911,0,3.824-0.729,5.28-2.188L87.12,97.686l23.151,23.153c1.458,1.458,3.369,2.188,5.28,2.188c1.911,0,3.821-0.729,5.28-2.188
                                                                                                        c2.917-2.917,2.917-7.642,0-10.559L97.679,87.127l23.151-23.153C123.747,61.057,123.747,56.331,120.83,53.414z"></path>
                                                                                                </g>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </span>
                                                                                </span>
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

                                                                    <span class="flex w-4 h-4 mr-6 items-center justify-center fill-current" @click.prevent="deleteQuestion(question.id)">
                                                                        <svg height="427pt" viewBox="-40 0 427 427.00131" width="427pt" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="m232.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"></path>
                                                                            <path d="m114.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"></path>
                                                                            <path d="m28.398438 127.121094v246.378906c0 14.5625 5.339843 28.238281 14.667968 38.050781 9.285156 9.839844 22.207032 15.425781 35.730469 15.449219h189.203125c13.527344-.023438 26.449219-5.609375 35.730469-15.449219 9.328125-9.8125 14.667969-23.488281 14.667969-38.050781v-246.378906c18.542968-4.921875 30.558593-22.835938 28.078124-41.863282-2.484374-19.023437-18.691406-33.253906-37.878906-33.257812h-51.199218v-12.5c.058593-10.511719-4.097657-20.605469-11.539063-28.03125-7.441406-7.421875-17.550781-11.5546875-28.0625-11.46875h-88.796875c-10.511719-.0859375-20.621094 4.046875-28.0625 11.46875-7.441406 7.425781-11.597656 17.519531-11.539062 28.03125v12.5h-51.199219c-19.1875.003906-35.394531 14.234375-37.878907 33.257812-2.480468 19.027344 9.535157 36.941407 28.078126 41.863282zm239.601562 279.878906h-189.203125c-17.097656 0-30.398437-14.6875-30.398437-33.5v-245.5h250v245.5c0 18.8125-13.300782 33.5-30.398438 33.5zm-158.601562-367.5c-.066407-5.207031 1.980468-10.21875 5.675781-13.894531 3.691406-3.675781 8.714843-5.695313 13.925781-5.605469h88.796875c5.210937-.089844 10.234375 1.929688 13.925781 5.605469 3.695313 3.671875 5.742188 8.6875 5.675782 13.894531v12.5h-128zm-71.199219 32.5h270.398437c9.941406 0 18 8.058594 18 18s-8.058594 18-18 18h-270.398437c-9.941407 0-18-8.058594-18-18s8.058593-18 18-18zm0 0"></path><path d="m173.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/>
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