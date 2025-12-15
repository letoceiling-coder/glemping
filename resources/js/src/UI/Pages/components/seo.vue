<template>
    <div class="card">

        <div class="card-body" >
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="flex gab-10 ai-center">
                            <span>Наименование страницы</span>
                        </label>
                        <mc-input v-model="this.storage.page.name" keys="name" type="text" class="form-control" />

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="flex gab-10">
                    <span>Ссылка</span>
                </label>
                <mc-input v-model="this.storage.page.slug"  keys="slug" type="text" class="form-control" />

            </div>
            <div class="form-group">
                <label class="flex gab-10">
                    <span>Заголовок страницы (title) ( 16 - 255 максимум символов) </span>
                    <i class="fa-solid fa-question"
                       title="title — это заголовок HTML-элемента, который кратко описывает содержимое веб-страницы."></i>
                </label>
                <mc-textarea v-model="this.storage.page.title"
                             class="form-control"
                             :class="this.storage.page.title.length > 255 ?'border-danger':''"
                             placeholder="Описание для моделей будет динамическим, обозначить по умолчанию"
                             :rows="2"
                             :cols="30"
                             keys="title"></mc-textarea>
            </div>
            <div class="form-group">
                <label class="flex gab-10">
                    <span>Заголовок ( 16 - 255 максимум символов) </span>
                    <i class="fa-solid fa-question"
                       title="Заголовок– это HTML-тег первого уровня, который задает заголовок страницы/блока сайта."></i>
                </label>
                <mc-textarea v-model="this.storage.page.head"
                             class="form-control"
                             :class="this.storage.page.head.length > 255 ?'border-danger':''"
                             placeholder="Описание для моделей будет динамическим, обозначить по умолчанию"
                             :rows="2"
                             :cols="30"

                             keys="head"></mc-textarea>
            </div>
            <div class="form-group">
                <label class="flex gab-10">
                    <span>Описание</span>
                    <i class="fa-solid fa-question"
                       title="Описание - это заголовок HTML-элемента, который содержит расширенное содержание web-страницы, как правило из 2-3 предложений с важными ключевыми словами."></i>
                </label>
                <mc-textarea v-model="this.storage.page.description"
                             class="form-control"
                             :class="this.storage.page.description.length > 2000 ?'border-danger':''"
                             placeholder="Описание для моделей будет динамическим, обозначить по умолчанию"
                             :rows="5"
                             :cols="30"
                             name="description"></mc-textarea>
            </div>
        </div>

    </div>
</template>

<script>
export default {
name: "seo"
}
</script>

<style scoped>

</style>
