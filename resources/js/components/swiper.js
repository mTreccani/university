import 'swiper/css';
// import Swiper JS
import Swiper, {Navigation, Pagination} from 'swiper';
// import Swiper styles
Swiper.use([Navigation, Pagination]);
const swiper = new Swiper('.swiper', {
    direction: 'horizontal',
    pagination: {
        clickable: true,
        type: 'bullets',
        el: '.swiper-pagination',
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    allowTouchMove: true,
    observer: true,
    observeParents: true,
    observeSlideChildren: true,
    slidesPerView: 'auto',
    slidesPerGroup: 2,
    spaceBetween: 30,
});
