import moment from "moment"

export function ConvertTime(value) {
    return moment(value).format("MMM Do YYYY")
}