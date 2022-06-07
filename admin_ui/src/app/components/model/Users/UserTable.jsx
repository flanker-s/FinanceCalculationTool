import SortingTable from "../../shared/Tables/Sorting/SortingTable"
import {ConvertTime} from "../../../utils/Converters/TimeConverter"

function UserTable({items, editHandler, removeHandler}) {

    const handleEdit = id => editHandler(id)
    const handleRemove = id => removeHandler(id)

    const tableItems = items.map(item =>{
        return {
            id: item.id,
            properties: [
                {
                    tableName: 'Name',
                    sortId: 'name',
                    value: item.attributes.name
                },
                {
                    tableName: 'Email',
                    sortId: 'email',
                    value: item.attributes.email
                },
                {
                    tableName: 'Created At',
                    sortId: 'created_at',
                    value: ConvertTime(item.attributes.created_at)
                },
                {
                    tableName: 'Id',
                    sortId: 'id',
                    value: item.id
                },
            ]
        }
    })

    return (
        <SortingTable
            tableItems = {tableItems}
            editHandler={handleEdit}
            removeHandler={handleRemove}
        />
    )
}

export default UserTable