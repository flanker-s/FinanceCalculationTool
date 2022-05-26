import React from 'react'
import BasicTabs from "../../components/BasicTabs/BasicTabs"
import TemplateArea from "../../components/ClientResources/Templates/TemplateArea"

function Expenses() {

    return (
        <BasicTabs tabs={{
            Templates: <TemplateArea
                operationId={2}
                defaultCategoryId={2}
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

export default Expenses