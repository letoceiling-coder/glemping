<template>

    <div :class="this.appendClass(data.view)" :id="`id-${data.id}`">
        <div id="contacts" class="bg-contact relative pb-3 pt-5"
             :style="`background: url(${getField('bg-image').image.webp}) 0% 0% / cover no-repeat;`">
            <div class="container z-10 relative">
                <div class="row flex jc-sb ">
                    <div class="col-md-8 col-12">
                        <h2 class="h2">Наши контакты</h2>
                        <div class="row mt-5">
                            <div class="card-blur p-3">
                                <div class="title">
                                    ОСТАЛИСЬ ВОПРОСЫ?
                                </div>
                                <div class="description mt-3">
                                    Оставьте свои контактные данные, чтобы наш менеджер связался с Вами и ответил на все
                                    Ваши вопросы или помог с бронированием
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-4 col-12 mb-3">
                                        <mc-input class="form-control" v-model="form.name"
                                                  placeholder="Ваше имя"></mc-input>
                                    </div>
                                    <div class="col-md-4 col-12 mb-3">
                                        <mc-input class="form-control" v-model="form.phone"
                                                  placeholder="+7 (900) 123-45-67"></mc-input>
                                    </div>
                                    <div class="col-md-4 col-12 mb-3">
                                        <Btn class="p-0 pl-3 pr-3 ">Заказать звонок</Btn>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label description" for="exampleCheck1">Я соглашаюсь
                                                на
                                                обработку персональных данных</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row  mt-5">
                            <div class="col-md-4 col-12 mb-3 flex w-100">
                                <div class="card-blur flex column gab-20 p-3 w-100">
                                    <div class="border-bottom pb-4">
                                        <svg width="30" height="24" viewBox="0 0 30 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M3.74372 23.7405C2.94701 23.7405 2.26497 23.4568 1.69762 22.8895C1.13027 22.3221 0.846588 21.6401 0.846588 20.8434V3.4606C0.846588 2.66389 1.13027 1.98186 1.69762 1.41451C2.26497 0.847154 2.94701 0.563477 3.74372 0.563477H26.9207C27.7174 0.563477 28.3995 0.847154 28.9668 1.41451C29.5342 1.98186 29.8179 2.66389 29.8179 3.4606V20.8434C29.8179 21.6401 29.5342 22.3221 28.9668 22.8895C28.3995 23.4568 27.7174 23.7405 26.9207 23.7405H3.74372ZM15.3322 13.6006L26.9207 6.35773V3.4606L15.3322 10.7034L3.74372 3.4606V6.35773L15.3322 13.6006Z"
                                                fill="#00BA57"/>
                                        </svg>
                                    </div>


                                    <div class="description">
                                        {{ this.storage.settings.const.email.text }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-3 flex w-100">
                                <div class="card-blur flex column gab-20 p-3 w-100">
                                    <div class="border-bottom pb-4">
                                        <svg width="27" height="27" viewBox="0 0 27 27" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M25.0737 26.1884C22.0558 26.1884 19.0742 25.5305 16.1288 24.2147C13.1834 22.899 10.5035 21.0339 8.08924 18.6197C5.67497 16.2054 3.80994 13.5255 2.49416 10.5801C1.17838 7.63472 0.520493 4.65309 0.520493 1.63525C0.520493 1.20068 0.665349 0.83854 0.955062 0.548827C1.24477 0.259114 1.60692 0.114258 2.04148 0.114258H7.90817C8.24617 0.114258 8.54795 0.228936 8.81352 0.458292C9.07909 0.687648 9.23602 0.959253 9.2843 1.27311L10.2259 6.34308C10.2742 6.72937 10.2621 7.05529 10.1897 7.32086C10.1172 7.58643 9.98444 7.81579 9.7913 8.00893L6.27853 11.5579C6.76139 12.4512 7.33478 13.3143 7.9987 14.1472C8.66263 14.9801 9.39295 15.7829 10.1897 16.5555C10.9381 17.3039 11.7227 17.998 12.5436 18.6378C13.3644 19.2776 14.2336 19.863 15.151 20.3942L18.5551 16.99C18.7724 16.7727 19.0561 16.6098 19.4061 16.5011C19.7562 16.3925 20.1002 16.3623 20.4382 16.4106L25.4358 17.4246C25.7738 17.5212 26.0514 17.6962 26.2687 17.9497C26.486 18.2032 26.5946 18.4869 26.5946 18.8007V24.6674C26.5946 25.102 26.4498 25.4641 26.1601 25.7538C25.8704 26.0436 25.5082 26.1884 25.0737 26.1884Z"
                                                fill="#00BA57"/>
                                        </svg>

                                    </div>


                                    <div class="description">
                                        {{ this.storage.settings.const.phone.text }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-3 flex w-100">
                                <div class="card-blur flex column gab-20 p-3 w-100">
                                    <div class="border-bottom pb-4">
                                        <svg width="26" height="38" viewBox="0 0 26 38" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M13 0C20.1871 0 26 5.81286 26 13C26 22.75 13 37.1429 13 37.1429C13 37.1429 0 22.75 0 13C0 5.81286 5.81286 0 13 0ZM3.71434 12.9996C3.71434 18.2924 9.1372 26.3896 13.0001 31.3481C16.9372 26.3524 22.2858 18.3481 22.2858 12.9996C22.2858 7.87386 18.1258 3.71386 13.0001 3.71386C7.87434 3.71386 3.71434 7.87386 3.71434 12.9996ZM13 17.6429C10.4358 17.6429 8.35714 15.5642 8.35714 13C8.35714 10.4358 10.4358 8.35714 13 8.35714C15.5642 8.35714 17.6429 10.4358 17.6429 13C17.6429 15.5642 15.5642 17.6429 13 17.6429Z"
                                                  fill="#00BA57"/>
                                        </svg>

                                    </div>


                                    <div class="description">
                                        {{ this.storage.settings.const.address.text }}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-12 flex social gab-30 mt-4">
                                <div class="flex ai-center gab-10">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 0C5.376 0 0 5.376 0 12C0 18.624 5.376 24 12 24C18.624 24 24 18.624 24 12C24 5.376 18.624 0 12 0ZM17.568 8.16C17.388 10.056 16.608 14.664 16.212 16.788C16.044 17.688 15.708 17.988 15.396 18.024C14.7 18.084 14.172 17.568 13.5 17.124C12.444 16.428 11.844 15.996 10.824 15.324C9.636 14.544 10.404 14.112 11.088 13.416C11.268 13.236 14.34 10.44 14.4 10.188C14.4083 10.1498 14.4072 10.1102 14.3968 10.0726C14.3863 10.0349 14.3668 10.0004 14.34 9.972C14.268 9.912 14.172 9.936 14.088 9.948C13.98 9.972 12.3 11.088 9.024 13.296C8.544 13.62 8.112 13.788 7.728 13.776C7.296 13.764 6.48 13.536 5.868 13.332C5.112 13.092 4.524 12.96 4.572 12.54C4.596 12.324 4.896 12.108 5.46 11.88C8.964 10.356 11.292 9.348 12.456 8.868C15.792 7.476 16.476 7.236 16.932 7.236C17.028 7.236 17.256 7.26 17.4 7.38C17.52 7.476 17.556 7.608 17.568 7.704C17.556 7.776 17.58 7.992 17.568 8.16Z"
                                            fill="white"/>
                                    </svg>
                                    <a :href="`https://t.me/${this.storage.settings.const.telegram.text}`">{{ this.storage.settings.const.telegram.text }}</a>
                                </div>
                                <div class="flex ai-center gab-10">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.5025 3.49206C19.3967 2.38099 18.0796 1.50002 16.6282 0.900497C15.1767 0.300974 13.6198 -0.00511579 12.0482 6.4674e-05C5.46332 6.4674e-05 0.0964826 5.34005 0.0964826 11.892C0.0964826 13.992 0.651256 16.032 1.68844 17.832L0 24L6.33166 22.344C8.0804 23.292 10.0462 23.796 12.0482 23.796C18.6332 23.796 24 18.456 24 11.904C24 8.72404 22.7578 5.73605 20.5025 3.49206ZM12.0482 21.78C10.2633 21.78 8.51457 21.3 6.98291 20.4L6.6211 20.184L2.85829 21.168L3.8593 17.52L3.61809 17.148C2.62619 15.5725 2.09961 13.7512 2.09849 11.892C2.09849 6.44405 6.5608 2.00406 12.0362 2.00406C14.6894 2.00406 17.1859 3.03606 19.0553 4.90805C19.981 5.82469 20.7147 6.9151 21.2136 8.11604C21.7126 9.31698 21.9669 10.6045 21.9618 11.904C21.9859 17.352 17.5236 21.78 12.0482 21.78ZM17.4995 14.388C17.198 14.244 15.7266 13.524 15.4613 13.416C15.1839 13.32 14.991 13.272 14.7859 13.56C14.5809 13.86 14.0141 14.532 13.8452 14.724C13.6764 14.928 13.4955 14.952 13.194 14.796C12.8925 14.652 11.9276 14.328 10.794 13.32C9.90151 12.528 9.31055 11.556 9.12965 11.256C8.9608 10.956 9.10553 10.8 9.26231 10.644C9.39497 10.512 9.56382 10.296 9.70854 10.128C9.85327 9.96004 9.91357 9.82804 10.01 9.63604C10.1065 9.43204 10.0583 9.26404 9.98593 9.12004C9.91357 8.97604 9.31055 7.51204 9.06935 6.91205C8.82814 6.33605 8.57487 6.40805 8.39397 6.39605H7.81507C7.61005 6.39605 7.29648 6.46805 7.01909 6.76805C6.75377 7.06805 5.98191 7.78804 5.98191 9.25204C5.98191 10.716 7.05528 12.132 7.2 12.324C7.34472 12.528 9.31055 15.528 12.3015 16.812C13.0131 17.124 13.5678 17.304 14.002 17.436C14.7136 17.664 15.3648 17.628 15.8834 17.556C16.4623 17.472 17.6563 16.836 17.8975 16.14C18.1508 15.444 18.1508 14.856 18.0663 14.724C17.9819 14.592 17.801 14.532 17.4995 14.388Z"
                                            fill="white"/>
                                    </svg>
                                    <a :href="`https://wa.me/`+this.storage.settings.const.whatsapp.text.replace(/\D/g, '')">
                                        {{ this.storage.settings.const.whatsapp.text }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none d-md-block">
                            <div class="col-12 flex  gab-30 mt-4">
                                <router-link to="/police" class="description">Политика конфиденциальности</router-link>
                                <router-link to="/agreement" class="description">Пользовательское соглашение
                                </router-link>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <picture>
                            <source :srcset="getField('image').image.webp"
                                    type="image/webp">
                            <img :src="getField('image').image.src" :alt="getField('image').image.name" class="w-100">
                        </picture>
                        <div class="row mt-3 mobile-show">
                            <div class="col-12 ">
                                <router-link to="/police" class="description">Политика конфиденциальности</router-link>
                            </div>
                            <div class="col-12 ">
                                <router-link to="/agreement" class="description">Пользовательское соглашение
                                </router-link>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>

    </div>



</template>

<script>


export default {
    name: "index",

    props: {
        data: Object,
    },
    data() {
        return {
            form: {
                name: '',
                phone: '',
            }
        }
    },
    methods: {


        getField(name) {
            return this.data.fields.find(item => item.space === name)
        }
    },
    mounted() {

    },

}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';

.mobile-show {
    display: none;
}

@media only screen and (max-width: 767px) {
    .mobile-show {
        display: flex;
    }


}

.social {
    a {
        font-family: 'Onest';
        font-style: normal;
        font-weight: 400;
        font-size: 12px;
        line-height: 15px;

        color: #FFFFFF;
    }
}

.card-blur {
    background: rgba(255, 255, 255, 0.04);
    backdrop-filter: blur(25.7297px);
    border-radius: 20px;

}

.title {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 24px;
    line-height: 34px;
    color: #FFFFFF;
}

.description {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 20px;
    color: rgba(255, 255, 255, 0.9);
}

.bg-contact {

    height: 100%;
    width: 100%;

    &:before {
        content: '';
        display: block;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, .5);
        z-index: 5;
    }
}

.h2 {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 36px;
    line-height: 50px;

    color: #FFFFFF;
}
img{
    border-radius: 20px;
}
</style>
