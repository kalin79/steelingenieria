<template>
    <div class="ventajasSection">
        <div class="container">
            <div class="headerContainer">
                <h2>
                    Las ventajas de los <br />
                    <span>remolcadores eléctricos</span>
                </h2>
            </div>
            <div class="bodyContainer">
                <div
                    class="cardContainer"
                    v-for="(item, index) in ventajas"
                    :key="index"
                >
                    <div class="iconContainer">
                        <img :src="item.image" />
                    </div>
                    <div class="infoBox">
                        <h3 v-html="item.title"></h3>
                        <p v-html="item.description"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
const ventajas = [
    {
        id: 1,
        title: `Mejore la seguridad`,
        description: `Elimine la manipulación manual de cargas y reduzca la dependencia de grúas y montacargas.`,
        image: `/images/icon1.svg`,
    },
    {
        id: 2,
        title: `Mejore la seguridad`,
        description: `Elimine la manipulación manual de cargas y reduzca la dependencia de grúas y montacargas.`,
        image: `/images/icon3.svg`,
    },
    {
        id: 3,
        title: `Mejore la seguridad`,
        description: `Elimine la manipulación manual de cargas y reduzca la dependencia de grúas y montacargas.`,
        image: `/images/icon3.svg`,
    },
    {
        id: 4,
        title: `Mejore la seguridad`,
        description: `Elimine la manipulación manual de cargas y reduzca la dependencia de grúas y montacargas.`,
        image: `/images/icon4.svg`,
    },
    {
        id: 5,
        title: `Mejore la seguridad`,
        description: `Elimine la manipulación manual de cargas y reduzca la dependencia de grúas y montacargas.`,
        image: `/images/icon5.svg`,
    },
];
</script>
<style lang="scss" scoped>
.ventajasSection {
    background-color: $color-primary-dark;
    background-image: url("/images/bg2.webp");
    background-position: 0 0;
    background-size: cover;
    background-repeat: repeat;
    padding: 5rem 0 6rem;
    @media screen and (min-width: 992px) {
        padding: 8rem 0 10rem;
    }
    .bodyContainer {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 3rem;
        width: 100%;
        margin-top: 5rem;
        @media screen and (min-width: 992px) {
            grid-template-columns: repeat(3, 1fr);
        }
        .cardContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            flex-direction: column;
            @media screen and (min-width: 992px) {
                flex-direction: row;
                justify-content: flex-start;
                align-items: flex-start;
            }
            .infoBox {
                flex: 1;
                padding: 0 2rem;
                @media screen and (min-width: 992px) {
                    padding: 0;
                }
                h3 {
                    font-size: 1.25rem;
                    line-height: 1.5em;
                    color: $color-primary-light;
                    font-family: $font-sans;
                    font-weight: 400;
                    text-align: center;
                    @media screen and (min-width: 992px) {
                        font-size: 1rem;
                        line-height: 1.5em;
                        text-align: left;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 1.25rem;
                        line-height: 1.25em;
                    }
                }
                p {
                    font-size: 1rem;
                    line-height: 1.5em;
                    color: white;
                    font-family: $font-sans;
                    font-weight: 400;
                    text-align: center;
                    @media screen and (min-width: 992px) {
                        font-size: 0.9rem;
                        line-height: 1.5em;
                        text-align: left;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 1rem;
                        line-height: 1.5em;
                    }
                }
            }
            .iconContainer {
                flex: 0 0 82px;
                img {
                    width: 100%;
                    height: auto;
                    object-fit: contain;
                }
            }
        }
    }
    .headerContainer {
        h2 {
            text-align: center;
            font-size: 2rem;
            line-height: 1.25em;
            color: white;
            font-family: $font-archia;
            font-weight: 400;
            @media screen and (min-width: 992px) {
                font-size: 2.225rem;
                line-height: 1em;
            }
            @media screen and (min-width: 1200px) {
                font-size: 2.625rem;
                line-height: 1em;
            }
            span {
                font-weight: 500;
            }
        }
    }
}
</style>
