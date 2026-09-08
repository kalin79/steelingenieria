<template>
    <section class="contactenosSection">
        <div class="container">
            <div class="layoutContainer">
                <div>
                    <div class="etiquetaContainer">
                        <span>Contáctenos</span>
                    </div>
                    <h2>Construyamos juntos una solución para <br />tu proyecto.</h2>
                </div>
                <div>
                    <div class="infoContainer">
                        <p>
                            ¿Tienes una idea, un proyecto o un requerimiento específico? 
                            Escríbenos y conversemos. Nuestro equipo está preparado para brindarte asesoría y acompañarte en cada etapa para encontrar la solución que necesitas.
                        </p>
                    </div>
                </div>
                <div>
                    <div class="itemsContainer" v-for="(item, index) in items" :key="index">
                        <div class="iconContainer">
                            <img :src="item.images"/>
                        </div>
                        <div class="detalleContainer">
                            <a
                                v-if="item.link"
                                :href="item.link"
                                v-html="item.title"
                            ></a>
                            <span v-else v-html="item.title"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
const items = [
    {
        images: '/images/iconContacto1.png',
        title: `Mz. EV Lote 3 Urb. Libertadores <br />SMP, Lima, Peru, Lima 31`
    },
    {
        images: '/images/iconContacto2.png',
        title: `(+511) 469.8186`
    },
    {
        images: '/images/iconContacto3.png',
        title: `ventas@steelingenieria.com`,
        link: `mailto:ventas@steelingenieria.com`,
    },
    {
        images: '/images/iconContacto4.png',
        title: `LUN - VIE de 8:00 am a 7:00pm <br />SAB 8:00 am a 2:00pm`
    },
]
</script>
<style lang="scss" scoped>

.contactenosSection{
    background-image: url("/images/f2.webp");
    background-position: top left;
    background-size: cover; 
    background-repeat: repeat;
    .container{
        .layoutContainer {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1rem;
            padding: 5rem 0 5rem;
            @media screen and (min-width: 992px) {
                padding: 5rem 0 2rem;
            }
            > div {
                &:nth-of-type(3){
                    grid-column: 1 / -1;
                    display: flex;
                    justify-content: flex-start;
                    align-items: flex-start;
                    gap: 1rem;
                    margin-top: 1rem;
                    flex-direction: column;
                    @media screen and (min-width: 992px){
                        flex-direction: row;
                        justify-content: space-between;
                        align-items: center;
                        margin-top: 3rem;
                    }
                    .itemsContainer{
                        display: flex;
                        align-items: center;
                        gap: 1rem;
                        @media screen and (min-width: 992px){
                            align-items: center;
                        }
                        .detalleContainer{
                            flex: 1;
                            span, a {
                                font-size: .9rem;
                                line-height: 1.5em;
                                color: $color-text-light;
                                font-family: $font-sans;
                                font-weight: 400;
                                margin: 1rem 0 0.5rem;
                                @media screen and (min-width: 992px) {
                                    font-size: .9rem;
                                    line-height: 1.5em;
                                }
                                @media screen and (min-width: 1200px) {
                                    font-size: 1rem;
                                    line-height: 1.4em;
                                }
                            }
                        }
                        .iconContainer{
                            flex: 0 0 62px;
                            width: 62px;
                            height: 62px;
                            img{
                                width: 100%;
                                height: 100%;
                                object-fit: contain;
                            }
                        }

                    }
                }
                &:nth-of-type(2){
                    grid-column: 1 / -1;
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-end;
                    align-items: flex-start;
                    
                    @media screen and (min-width: 992px) {
                        grid-column: 7 / -1;
                    }
                    .infoContainer{
                        p {
                            font-size: 1rem;
                            line-height: 1.5em;
                            color: $color-text-light;
                            font-family: $font-sans;
                            font-weight: 400;
                            margin: 1rem 0 0.5rem;
                            @media screen and (min-width: 992px) {
                                font-size: 1rem;
                                line-height: 1.5em;
                            }
                            @media screen and (min-width: 1200px) {
                                font-size: 1.125rem;
                                line-height: 1.4em;
                            }
                        }
                    }
                    
                }
                &:nth-of-type(1){
                    grid-column: 1 / -1;
                    @media screen and (min-width: 992px) {
                        grid-column: 1 / span 6;
                    }
                    h2 {
                        font-size: 1.5rem;
                        line-height: 1.15em;
                        color: $color-text-light;
                        font-family: $font-sans;
                        font-weight: 400;
                        margin: 1rem 0 0.5rem;
                        @media screen and (min-width: 992px) {
                            font-size: 1.65rem;
                            line-height: 1em;
                        }
                        @media screen and (min-width: 1200px) {
                            font-size: 1.875rem;
                            line-height: 1em;
                        }
                    }
                    .etiquetaContainer {
                        border: 1px solid $color-primary-light;
                        border-radius: 30px;
                        min-width: 216px;
                        height: 34px;
                        display: inline-block;
                        text-align: center;
                        span {
                            font-size: 0.9rem;
                            line-height: 2.35em;
                            color: $color-primary-light;
                            font-family: $font-red;
                            font-weight: 600;
                            @media screen and (min-width: 992px) {
                                font-size: 0.9rem;
                                line-height: 2.35em;
                            }
                            @media screen and (min-width: 1200px) {
                                font-size: 1rem;
                                line-height: 2em;
                            }
                        }
                    }
                }
                
            }
        }
    }
    
}
</style>