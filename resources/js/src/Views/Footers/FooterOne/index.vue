<template>
    <footer class="footer" v-if="menus && menus.length > 0">
        <div class="container">
            <nav class="footer-nav">
                <ul class="footer-menu">
                    <li v-for="menu in menus" :key="menu.id">
                        <a :href="menu.route || `#${menu.slug}`" @click.prevent="anchorTo">{{ menu.name }}</a>
                    </li>
                </ul>
            </nav>
        </div>
    </footer>
</template>

<script>
export default {
    name: "FooterOne",
    props: {
        data: Object,
    },
    data() {
        return {
            menus: []
        }
    },
    mounted() {
        this.getMenus()
    },
    methods: {
        async getMenus() {
            try {
                const response = await axios.get('/api/v1/menus-footer')
                this.menus = response.data.data || []
            } catch (error) {
                console.error('Error loading footer menus:', error)
            }
        },
        anchorTo(e) {
            const href = $(e.target).attr('href')
            if (href && typeof href === 'string' && href.startsWith('#')) {
                const destination = $(href)
                if (destination.length) {
                    $('body,html').animate({scrollTop: destination.offset().top - 100}, 1400)
                } else {
                    this.$router.push(href.replace('#', '/'))
                }
            } else if (href && typeof href === 'string') {
                window.location.href = href
            }
        }
    }
}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';

.footer {
    padding: 2rem 0;
    background-color: #1a1a1a;
    color: #fff;
}

.footer-menu {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 2rem;

    li {
        a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 14px;
            transition: opacity 0.3s;

            &:hover {
                opacity: 0.7;
            }
        }
    }
}

@media only screen and (max-width: 767px) {
    .footer-menu {
        flex-direction: column;
        gap: 1rem;
    }
}
</style>

