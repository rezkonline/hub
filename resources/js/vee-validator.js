import { extend } from "vee-validate";
import { required, alpha_num, alpha_dash, min, max, email, confirmed, digits, regex } from "vee-validate/dist/rules";

extend("required", required);

extend("alpha_num", alpha_num);

extend("alpha_dash", alpha_dash);

extend("min", min);

extend("max", max);

extend("email", email);

extend("confirmed", confirmed);

extend("digits", digits);

extend("regex", regex);
