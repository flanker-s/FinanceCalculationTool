import React from 'react'
import BasicTabs from "../../components/BasicTabs/BasicTabs"
import TemplateArea from "../../components/ClientResources/Templates/TemplateArea"

function Incomes() {

    return (
        <BasicTabs tabs={{
            Templates: <TemplateArea
                operationId={1}
                defaultCategoryId={1}
                tableParams={{
                    fields: {
                        name: 'Name',
                        category: 'Category',
                        created_at: 'Created at',
                        id: 'Id',
                    }
                }}
            />,
            Categories: <div>Categories</div>
        }}/>
    )
}

export default Incomes