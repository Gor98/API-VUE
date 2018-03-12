<template>
    <div>
        <h2>Articles</h2>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{ disabled: !pagination.prev}]">
                    <a class="page-link " @click="fetchArticles(pagination.prev)" href="#">Previous</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">{{pagination.current_page}} of {{pagination.last_page}}</a>
                </li>
                <li v-bind:class="[{disabled: !pagination.next}]">
                    <a class="page-link " @click="fetchArticles(pagination.next)" href="#">next</a>
                </li>
            </ul>
        </nav>
        <div class="card card-body mb-4" v-for="article in articles" v-bind:key="article.id">
            <h3>{{article.title}}</h3>
            <p>{{article.body}}</p>
            <hr>
            <button class="btn btn-danger mb-2" @click="deleteArticle(article.id)">DELETE</button>
            <button class="btn btn-warning" @click="editArticle(article.id)">EDIT</button>
        </div>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                articles: {},
                article: {
                    id: '',
                    title: '',
                    body: ''
                },
                article_id: '',
                pagination: {},
                edit: false
            }
        },

        created() {
            this.fetchArticles();
        },

        methods: {

            fetchArticles(page_url) {
                let vm = this;
                page_url = page_url || '/api/articles';
                fetch(page_url)
                    .then(res => res.json())
                        .then(res =>{
                            this.articles = res.data;
                            vm.makePagination(res.meta, res.links);
                        })
                    .catch(err => console.log(err));
            },
            makePagination(meta, links){
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next: links.next,
                    prev: links.prev
                };
                this.pagination = pagination;
            },

            deleteArticle(id){
                if(confirm('Are You Sure')){
                    fetch(`/api/article/${id}`, {
                        method: 'delete'
                    })
                        .then(res => res.json())
                        .then(data =>{
                            alert('Article Removed');
                            this.fetchArticles();
                        })
                        .catch(err => console.log(err))
                }
            }

        }

    }
</script>