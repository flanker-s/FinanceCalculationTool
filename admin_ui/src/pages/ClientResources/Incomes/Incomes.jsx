import React from 'react'
import BasicTabs from "../../../components/shared/Tabs/BasicTabs"
import TemplateArea from "../../../components/model/ClientResources/Templates/TemplateArea"
import CategoryArea from "../../../components/model/ClientResources/Categories/CategoryArea"

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