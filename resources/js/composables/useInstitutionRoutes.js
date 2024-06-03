import { usePage } from '@inertiajs/vue3';

export function useInstitutionRoutes() {
    const page = usePage();
    const institution_id = page.props.auth.user.institution_id;

    function route(name, params = {}, absolute) {
        return window.route(name, params, absolute);
    }

    return { route };
}