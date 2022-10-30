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
            />,
            Categories: <CategoryArea
                operationId={1}
            />
        }}/>
    )
}

export default Incomes