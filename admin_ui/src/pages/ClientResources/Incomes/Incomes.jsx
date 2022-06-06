import React from 'react'
import BasicTabs from "../../../app/components/shared/BasicTabs/BasicTabs"
import TemplateArea from "../../../app/components/model/ClientResources/Templates/TemplateArea"
import CategoryArea from "../../../app/components/model/ClientResources/Categories/CategoryArea"

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
            Categories: <CategoryArea
                operationId={1}
                tableParams={{
                    fields: {
                        name: 'Name',
                        created_at: 'Created at',
                        id: 'Id',
                    }
                }}
            />
        }}/>
    )
}

export default Incomes